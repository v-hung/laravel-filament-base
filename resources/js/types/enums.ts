// Enum Types
export enum CategoryStatus {
    Active = 'active',
    Inactive = 'inactive',
    Archived = 'archived',
}

export enum ContentStatus {
    Draft = 'draft',
    Reviewing = 'reviewing',
    Published = 'published',
    Rejected = 'rejected',
}

export enum OrderStatus {
    Pending = 'pending',
    Paid = 'paid',
    Shipped = 'shipped',
    Completed = 'completed',
    Canceled = 'canceled',
}

export enum PaymentMethod {
    BankTransfer = 'bank_transfer',
    CashDelivery = 'cash_delivery',
}

export enum PaymentStatus {
    Pending = 'pending',
    Paid = 'paid',
    Failed = 'failed',
    Refunded = 'refunded',
    Canceled = 'canceled',
}

export enum ProductStatus {
    Active = 'active',
    Inactive = 'inactive',
    OutOfStock = 'out_of_stock',
    ComingSoon = 'coming_soon',
    Discontinued = 'discontinued',
}

export enum ShowcaseType {
    Testimonial = 'testimonial',
    Partner = 'partner',
}

export enum Status {
    Active = 'active',
    Archived = 'archived',
}

export enum ProductOrderType {
    BestSelling = 'best_selling',
    Featured = 'featured',
    Latest = 'latest',
    PriceAsc = 'price_asc',
    PriceDesc = 'price_desc',
}
