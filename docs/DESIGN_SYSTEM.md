# VoteTune Design System

## Core Philosophy
The new VoteTune design uses an "AI-era SaaS" visual aesthetic:
- **Glassmorphism**: Translucent cards (`vt-glass`) with blurred backgrounds.
- **Vibrant Gradients**: Accent elements use `linear-gradient(135deg, var(--bs-primary), #4f46e5)`.
- **Soft Shadows**: Modern, deep shadows (`shadow-sm`, `shadow-lg`) replacing flat borders.
- **Unified Icons**: Standardized `lucide-icons` for all navigation and UI elements.

## Roles and Personas

### 1. Administrator
- **Vibe**: Enterprise control center.
- **Color Identity**: Cool, analytical blues/grays with high data density.
- **Navigation**: Dedicated sidebar (`partials.admin-sidebar`).
- **Use Case**: Platform management, metrics, and global settings.

### 2. Host
- **Vibe**: Live event dashboard.
- **Color Identity**: High contrast, active elements, focus on live status (`badge bg-success bg-opacity-10`).
- **Navigation**: Dedicated sidebar (`partials.host-sidebar`).
- **Use Case**: Managing live rooms, curating songs, engaging the audience.

### 3. User
- **Vibe**: Engaging, simple participant interface.
- **Color Identity**: Warm, accessible, mobile-first design.
- **Navigation**: Dedicated sidebar/nav (`partials.user-sidebar`).
- **Use Case**: Joining rooms via code/QR, voting on songs.

## Global Components

### `<x-statistic-card>`
Used universally to display key metrics across all dashboards.
- **Props**: `title`, `value`, `icon`, `trend`, `trendValue`
- **Style**: Soft primary background icon, large typography.

### `<x-flash-message>`
Unified toast notifications for success/error handling powered by `App.toast`.
- **Style**: Replaces clunky server-rendered alerts with smooth JS-driven toasts.
- **Implementation**: Anonymous Blade component in `resources/views/components/flash-message.blade.php`.
