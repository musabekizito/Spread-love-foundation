-- Extend donations table with manual-payment fields
ALTER TABLE donations
    ADD COLUMN payment_method VARCHAR(30) DEFAULT NULL AFTER currency,
    ADD COLUMN payer_phone VARCHAR(30) DEFAULT NULL AFTER payment_method,
    ADD COLUMN payer_name VARCHAR(100) DEFAULT NULL AFTER payer_phone,
    ADD COLUMN message TEXT DEFAULT NULL AFTER payer_name,
    ADD COLUMN transaction_ref VARCHAR(100) DEFAULT NULL AFTER reference,
    ADD COLUMN verified_by INT DEFAULT NULL AFTER status,
    ADD COLUMN verified_at DATETIME DEFAULT NULL AFTER verified_by,
    ADD COLUMN notes TEXT DEFAULT NULL AFTER verified_at;