import test from 'node:test';
import assert from 'node:assert/strict';
import calculator from '../../resources/js/savings-rate-calculator.js';

test('reproduces the reference example and separates cash from contributions', () => {
    const state = calculator(); state.loadExample();
    assert.equal(state.incomeCents, 1450000);
    assert.equal(state.expenseCents, 1130000);
    assert.equal(state.savingsCents, 320000);
    assert.equal(state.cashSurplusCents, 70000);
    assert.equal(state.formatRate(state.savingsRate), '22.1%');
});

test('handles zero income without dividing by zero', () => {
    const state = calculator(); state.expenses.food = 100;
    assert.equal(state.savingsCents, -10000);
    assert.equal(state.savingsRate, null);
});

test('preserves deficits instead of clamping them to zero', () => {
    const state = calculator(); state.income.salary1 = 100; state.expenses.food = 150;
    assert.equal(state.savingsCents, -5000);
    assert.equal(state.savingsRate, -50);
});

test('adds cents accurately and treats cleared fields as zero', () => {
    const state = calculator(); state.income.salary1 = '0.10'; state.income.salary2 = '0.20';
    state.income.additional = '';
    assert.equal(state.incomeCents, 30);
});

test('rejects negative, nonfinite, and out of range amounts', () => {
    for (const value of [-1, Infinity, 'invalid', 1000000001]) {
        const state = calculator(); state.expenses.housing = value;
        assert.equal(state.hasInvalidAmounts, true);
        assert.equal(state.savingsRate, null);
        assert.equal(state.incomeCents, null);
    }
});

test('formats plain amounts and reset clears all amounts', () => {
    const state = calculator(); state.loadExample();
    assert.equal(state.savingsCents, 320000);
    assert.equal(state.formatMoney(state.savingsCents), '3,200.00');
    state.reset();
    assert.equal(state.incomeCents, 0); assert.equal(state.expenseCents, 0);
    assert.equal(state.savingsRate, null);
});
