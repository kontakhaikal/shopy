const Currency = {
    IDR: "IDR",
    USD: "USD",
} as const;

export function formatCurrency(
    amount: number,
    currency: (typeof Currency)[keyof typeof Currency]
) {
    switch (currency) {
        case Currency.USD:
            return `$${amount}`;
        case Currency.IDR:
            return `Rp${amount}`;
        default:
            return amount;
    }
}
