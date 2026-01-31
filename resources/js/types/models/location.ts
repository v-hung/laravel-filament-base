export type Province = {
    id: number;
    code?: string | null;
    codename?: string | null;
    division_type?: string | null;
    name?: string | null;
    phone_code?: string | null;
    created_at?: string;
    updated_at?: string;
    wards?: Ward[];
    [key: string]: unknown;
};

export type Ward = {
    id: number;
    code?: string | null;
    codename?: string | null;
    division_type?: string | null;
    name?: string | null;
    province_id: number;
    created_at?: string;
    updated_at?: string;
    province?: Province;
    [key: string]: unknown;
};
