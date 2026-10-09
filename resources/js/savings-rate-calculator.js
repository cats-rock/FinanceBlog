export const incomeFields = [
    { key: 'salary1', label: 'Salary 1 (net)' },
    { key: 'salary2', label: 'Salary 2 (net)' },
    { key: 'employer', label: 'Employer contributions', help: 'Savings or pension contributions paid by your employer. Do not include amounts already counted in net salary.' },
    { key: 'additional', label: 'Additional income / business' },
    { key: 'benefits', label: 'Benefits / other income' },
];

export const expenseFields = [
    { key: 'housing', label: 'Housing / rent / mortgage' },
    { key: 'food', label: 'Food and groceries' },
    { key: 'transport', label: 'Car and transport' },
    { key: 'bills', label: 'Bills and communications' },
    { key: 'education', label: 'Children and education' },
    { key: 'leisure', label: 'Leisure and entertainment' },
    { key: 'other', label: 'Other / unexpected expenses' },
];

const maximumAmount = 1000000000;
const emptyAmounts = (fields) => Object.fromEntries(fields.map(({ key }) => [key, 0]));
const validAmount = (value) => value === '' || (Number.isFinite(Number(value)) && Number(value) >= 0 && Number(value) <= maximumAmount);
const totalCents = (amounts) => Object.values(amounts).reduce((total, value) => total + Math.round(Number(value || 0) * 100), 0);

export default function savingsRateCalculator() {
    return {
        incomeFields,
        expenseFields,
        income: emptyAmounts(incomeFields),
        expenses: emptyAmounts(expenseFields),
        get hasInvalidAmounts() {
            return [...Object.values(this.income), ...Object.values(this.expenses)].some(value => !validAmount(value));
        },
        get incomeCents() { return this.hasInvalidAmounts ? null : totalCents(this.income); },
        get expenseCents() { return this.hasInvalidAmounts ? null : totalCents(this.expenses); },
        get savingsCents() { return this.hasInvalidAmounts ? null : this.incomeCents - this.expenseCents; },
        get cashSurplusCents() {
            return this.hasInvalidAmounts ? null : this.savingsCents - Math.round(Number(this.income.employer || 0) * 100);
        },
        get savingsRate() {
            return this.hasInvalidAmounts || this.incomeCents === 0 ? null : this.savingsCents / this.incomeCents * 100;
        },
        formatMoney(cents) {
            return cents === null ? 'Unavailable' : new Intl.NumberFormat('en', {
                minimumFractionDigits: 2, maximumFractionDigits: 2,
            }).format(cents / 100);
        },
        formatRate(rate) { return rate === null ? 'Unavailable' : rate.toFixed(1) + '%'; },
        loadExample() {
            this.income = { salary1: 12000, salary2: 0, employer: 2500, additional: 0, benefits: 0 };
            this.expenses = { housing: 4500, food: 3000, transport: 1500, bills: 800, education: 0, leisure: 1000, other: 500 };
        },
        reset() {
            this.income = emptyAmounts(incomeFields);
            this.expenses = emptyAmounts(expenseFields);
        },
    };
}
