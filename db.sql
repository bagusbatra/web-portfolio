-- CREATE TABLE STATUS

CREATE TABLE status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    status VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO status (status, slug) VALUES
('Available for hire', 'available-for-hire'),
('Available for project', 'available-for-project'),
('Ready to collaborate', 'ready-to-collaborate'),
('Open for freelance', 'open-for-freelance'),
('Limited Availability', 'limited-availability'),
('Selective available', 'selective-available'),
('Full booked', 'full-booked'),
('Not available right now', 'not-available-right-now'),
('Not Available', 'not-available');

