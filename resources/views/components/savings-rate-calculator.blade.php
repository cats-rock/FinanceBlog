<section x-data="savingsRateCalculator" aria-labelledby="savings-calculator-heading">
    <h2 id="savings-calculator-heading" class="text-heading-l font-normal tracking-[-0.02em] text-ink">
        Savings rate calculator
    </h2>
    <p class="mt-4 text-body-s text-ink-muted">
        Enter your monthly income and expenses in one currency. Your savings rate is the percentage of income left after expenses.
        Employer contributions count toward savings, but are shown separately from cash available to spend.
    </p>
    <noscript><p class="mt-4 text-body-s text-accent-coral">Enable JavaScript to use this calculator.</p></noscript>

    <div class="mt-6 flex flex-wrap items-end gap-4">
        <button type="button" x-on:click="loadExample()" class="pressable rounded-md border border-ink bg-accent-teal px-3.5 py-2.5 font-label text-label-s text-ink">Load example</button>
        <button type="button" x-on:click="reset()" class="pressable rounded-md border border-ink bg-paper px-3.5 py-2.5 font-label text-label-s text-ink">Reset amounts</button>
    </div>
    <p class="mt-3 text-body-s text-ink-muted">Inputs are not saved.</p>

    <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-2">
        <fieldset class="min-w-0 rounded-md border border-rule bg-paper p-6">
            <legend class="px-2 font-label text-label-m text-ink">Monthly income</legend>
            <div class="flex flex-col gap-5">
                <template x-for="field in incomeFields" :key="field.key">
                    <div class="flex flex-col gap-2">
                        <label :for="'savings-income-' + field.key" class="font-label text-label-s text-ink-soft" x-text="field.label"></label>
                        <input
                            :id="'savings-income-' + field.key"
                            :name="'income_' + field.key"
                            x-model="income[field.key]"
                            type="number" min="0" max="1000000000" step="0.01" inputmode="decimal"
                            :aria-describedby="field.help ? 'savings-help-' + field.key : null"
                            class="w-full rounded-md border border-rule-strong bg-paper px-3.5 py-2.5 text-body-s text-ink transition-colors duration-200 focus:border-accent-teal focus:outline-none focus-visible:ring-2 focus-visible:ring-accent-teal focus-visible:ring-offset-2 focus-visible:ring-offset-paper"
                        >
                        <template x-if="field.help">
                            <p :id="'savings-help-' + field.key" class="text-body-s text-ink-muted" x-text="field.help"></p>
                        </template>
                    </div>
                </template>
            </div>
            <p class="mt-6 flex flex-wrap justify-between gap-2 border-t border-rule pt-5 text-body-s font-semibold text-ink">
                <span>Total income</span><span x-text="formatMoney(incomeCents)">0.00</span>
            </p>
        </fieldset>
        <fieldset class="min-w-0 rounded-md border border-rule bg-paper p-6">
            <legend class="px-2 font-label text-label-m text-ink">Monthly expenses</legend>
            <div class="flex flex-col gap-5">
                <template x-for="field in expenseFields" :key="field.key">
                    <div class="flex flex-col gap-2">
                        <label :for="'savings-expenses-' + field.key" class="font-label text-label-s text-ink-soft" x-text="field.label"></label>
                        <input
                            :id="'savings-expenses-' + field.key"
                            :name="'expenses_' + field.key"
                            x-model="expenses[field.key]"
                            type="number" min="0" max="1000000000" step="0.01" inputmode="decimal"
                            :aria-describedby="field.help ? 'savings-help-' + field.key : null"
                            class="w-full rounded-md border border-rule-strong bg-paper px-3.5 py-2.5 text-body-s text-ink transition-colors duration-200 focus:border-accent-teal focus:outline-none focus-visible:ring-2 focus-visible:ring-accent-teal focus-visible:ring-offset-2 focus-visible:ring-offset-paper"
                        >
                        <template x-if="field.help">
                            <p :id="'savings-help-' + field.key" class="text-body-s text-ink-muted" x-text="field.help"></p>
                        </template>
                    </div>
                </template>
            </div>
            <p class="mt-6 flex flex-wrap justify-between gap-2 border-t border-rule pt-5 text-body-s font-semibold text-ink">
                <span>Total expenses</span><span x-text="formatMoney(expenseCents)">0.00</span>
            </p>
        </fieldset>
    </div>

    <p x-show="hasInvalidAmounts" style="display: none" role="alert" class="mt-6 text-body-s text-accent-coral">
        Enter amounts from 0 to 1,000,000,000. Correct invalid values to see the results.
    </p>
    <div class="mt-8 rounded-md border border-rule bg-paper p-6" aria-live="polite" aria-atomic="true">
        <h3 class="font-label text-label-m text-ink">Your monthly results</h3>
        <dl class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <dt class="font-label text-label-s text-ink-muted">Savings including contributions</dt>
                <dd class="mt-2 text-heading-l text-ink" x-text="formatMoney(savingsCents)">0.00</dd>
            </div>
            <div>
                <dt class="font-label text-label-s text-ink-muted">Savings rate</dt>
                <dd class="mt-2 text-heading-l text-ink" x-text="formatRate(savingsRate)">Unavailable</dd>
            </div>
            <div>
                <dt class="font-label text-label-s text-ink-muted">Cash remaining after expenses</dt>
                <dd class="mt-2 text-body-l text-ink" x-text="formatMoney(cashSurplusCents)">0.00</dd>
            </div>
            <div>
                <dt class="font-label text-label-s text-ink-muted">Annual savings at this pace</dt>
                <dd class="mt-2 text-body-l text-ink" x-text="formatMoney(savingsCents === null ? null : savingsCents * 12)">0.00</dd>
            </div>
        </dl>
        <p x-show="!hasInvalidAmounts && incomeCents === 0" class="mt-6 text-body-s text-ink-muted">Enter income greater than zero to calculate a savings rate.</p>
        <p x-show="!hasInvalidAmounts && savingsCents < 0" style="display: none" class="mt-6 text-body-s text-accent-coral">Your expenses exceed your total income.</p>
        <p class="mt-6 border-t border-rule pt-5 text-body-s text-ink-muted">
            Savings rate = (total income - total expenses) / total income &times; 100.
            Annual savings assumes these monthly amounts stay the same, without investment growth.
        </p>
    </div>
</section>
