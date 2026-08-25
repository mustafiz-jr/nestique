Nestique — Modern Single-Vendor E-Commerce Platform
Nestique is a feature-rich, single-vendor e-commerce platform built with Laravel and Filament PHP. It provides an intuitive shopping experience for customers and an advanced, powerful admin panel for managing products, inventory, orders, and customer communication in real time.

🚀 Key Features
🛍️ Customer-Facing Storefront
Dynamic Product Variants: Support for complex product options such as size, color, material, and custom combinations.

Seamless Checkout & Payments: Integrated with Stripe for secure credit/debit card processing.

Customer Dashboard: User profile management, order history, status tracking, and address management.

Live Chat Support: Real-time customer support integrated directly into the platform.

Automated Invoicing: Downloadable PDF invoices for completed orders.

⚙️ Admin & Store Management (Powered by Filament)
Advanced Stock Management: Real-time inventory tracking, variant-level stock control, and low-stock alerts.

Order Processing Workflow: Complete order lifecycle management (Pending ➔ Processing ➔ Shipped ➔ Delivered / Cancelled).

Courier & Logistics Ready: Modular courier management architecture (prepared for third-party API integration like Steadfast/Pathao).

Comprehensive Analytics: Store performance metrics, sales insights, and revenue tracking via Filament widgets.

🛠️ Tech Stack
Backend Framework: Laravel

Admin Panel & Resources: Filament PHP

Database: MySQL

Payment Gateway: Stripe API

Live Chat: WebSockets / Real-time events

Styling & UI: Tailwind CSS, Blade / Alpine.js

Version Control: Git & GitHub

graph TD;
    Customer[Customer / Storefront] -->|Browse & Select Variants| Cart[Shopping Cart];
    Cart -->|Checkout via Stripe| Payment{Payment Gateway};
    Payment -->|Success| Order[Order Created];
    Order -->|Trigger| Invoice[PDF Invoice Generated];
    Order -->|Real-time Sync| Admin[Filament Admin Panel];
    Admin -->|Manage| Stock[Stock Management];
    Admin -->|Process| Logistics[Courier & Shipping Prep];
    Customer <-->|Real-time Query| LiveChat[Live Chat System];

    Development Status: 🟢 Production Ready / Actively Maintained

Future Roadmap: Third-party courier API integrations (Pathao / Steadfast / RedX).

