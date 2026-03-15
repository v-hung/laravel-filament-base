export const isEmpty = (value: any): boolean => {
    if (value === null || value === undefined) return true;
    if (typeof value === 'string') return value.trim().length === 0;
    if (typeof value === 'number') return isNaN(value);
    if (typeof value === 'boolean') return false;
    if (Array.isArray(value))
        return (
            value.length === 0 ||
            value.every((item) => item === null || item === undefined)
        );
    if (value instanceof Map || value instanceof Set) return value.size === 0;
    if (typeof value === 'object') return Object.keys(value).length === 0;

    return false;
};
