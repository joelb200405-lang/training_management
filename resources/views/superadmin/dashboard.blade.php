<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SuperAdmin Dashboard - LEDIPO</title>

    <!-- Tab Icon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo_ledipo.png') }}">

    <!-- Shared LEDIPO Admin Dashboard Styling -->
    <link rel="stylesheet" href="{{ asset('stylesheet/admin-dashboard.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ==========================================================
           SUPERADMIN DASHBOARD ONLY
        ========================================================== */

        .superadmin-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }

        .superadmin-stat-card {
            background: #fff;
            border: 1px solid #e3e3e3;
            border-radius: 10px;
            padding: 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        }

        .superadmin-stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 9px;
            background: #e8f5e9;
            color: #025628;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 17px;
        }

        .superadmin-stat-info small {
            display: block;
            color: #777;
            font-size: 11px;
            margin-bottom: 3px;
        }

        .superadmin-stat-info strong {
            display: block;
            color: #025628;
            font-size: 22px;
            line-height: 1.1;
        }

        .superadmin-dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 20px;
            align-items: start;
        }

        .superadmin-card {
            background: #fff;
            border: 1px solid #e2e2e2;
            border-radius: 10px;
            padding: 18px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        }

        .superadmin-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .superadmin-card-header h3 {
            margin: 0;
            color: #004d26;
            font-size: 15px;
            font-weight: 700;
        }

        .superadmin-card-header span {
            color: #888;
            font-size: 11px;
        }

        .distribution-row {
            margin-bottom: 15px;
        }

        .distribution-row:last-child {
            margin-bottom: 0;
        }

        .distribution-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .distribution-label span {
            font-size: 12px;
            color: #444;
        }

        .distribution-label strong {
            font-size: 12px;
            color: #025628;
        }

        .distribution-bar {
            width: 100%;
            height: 7px;
            background: #edf1ee;
            border-radius: 10px;
            overflow: hidden;
        }

        .distribution-fill {
            height: 100%;
            background: #025628;
            border-radius: 10px;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 11px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .activity-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .activity-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #e8f5e9;
            color: #025628;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 12px;
        }

        .activity-content {
            min-width: 0;
        }

        .activity-content strong {
            display: block;
            color: #333;
            font-size: 12px;
            margin-bottom: 2px;
        }

        .activity-content small {
            color: #999;
            font-size: 10px;
        }

        .superadmin-page-card {
            background: #fff;
            border: 1px solid #e2e2e2;
            border-radius: 10px;
            padding: 18px;
        }

        .superadmin-page-card h3 {
            margin: 0 0 8px;
            color: #004d26;
            font-size: 16px;
        }

        .superadmin-page-card p {
            margin: 0;
            color: #777;
            font-size: 13px;
        }

        .superadmin-placeholder {
            margin-top: 18px;
            padding: 35px 20px;
            text-align: center;
            border: 1px dashed #cfd8d2;
            border-radius: 8px;
            background: #fafcfb;
            color: #888;
        }

        .superadmin-placeholder i {
            display: block;
            color: #025628;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .superadmin-placeholder strong {
            display: block;
            color: #555;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .superadmin-placeholder span {
            font-size: 11px;
        }


        /* ==========================================================
   ADMIN ACCOUNTS
========================================================== */

        /* ---------- Header ---------- */

        .admin-accounts-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 18px;
        }

        .admin-accounts-header h3 {
            margin-bottom: 6px;
        }

        .admin-accounts-header p {
            margin-bottom: 0;
        }


        /* ---------- Add Administrator Button ---------- */

        .superadmin-add-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 10px 16px;

            border: none;
            border-radius: 7px;

            background: #025628;
            color: #ffffff;

            font-size: 12px;
            font-weight: 700;

            cursor: pointer;
            white-space: nowrap;

            transition: background 0.2s ease;
        }

        .superadmin-add-btn:hover {
            background: #01451f;
        }


        /* ==========================================================
   ADMIN ACCOUNTS TABLE
========================================================== */

        .superadmin-table-wrapper {
            margin-top: 18px;
            width: 100%;
            overflow-x: auto;

            border: 1px solid #e2e2e2;
            border-radius: 8px;
        }

        .superadmin-table {
            width: 100%;
            min-width: 900px;

            background: #ffffff;

            border-collapse: collapse;
        }

        .superadmin-table thead {
            background: #f7faf8;
        }

        .superadmin-table th {
            padding: 13px 14px;

            text-align: left;

            color: #555;

            font-size: 11px;
            font-weight: 800;

            text-transform: uppercase;
            letter-spacing: 0.3px;

            border-bottom: 1px solid #e2e2e2;

            white-space: nowrap;
        }

        .superadmin-table td {
            padding: 14px;

            color: #444;

            font-size: 12px;

            border-bottom: 1px solid #eeeeee;

            vertical-align: middle;
        }

        .superadmin-table tbody tr:last-child td {
            border-bottom: none;
        }

        .superadmin-table tbody tr:hover {
            background: #fafcfb;
        }


        /* ---------- Administrator User ---------- */

        .admin-user-cell {
            display: flex;
            align-items: center;
            gap: 10px;

            min-width: 180px;
        }

        .admin-user-avatar {
            width: 34px;
            height: 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 50%;

            background: #e8f5e9;
            color: #025628;

            font-size: 11px;
            font-weight: 800;
        }

        .admin-user-cell strong {
            color: #333;

            font-size: 12px;
            font-weight: 700;
        }


        /* ---------- Status ---------- */

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 10px;
            font-weight: 800;

            white-space: nowrap;
        }

        .status-badge.active {
            background: #e8f5e9;
            color: #025628;
        }

        .status-badge.inactive,
        .status-badge.disabled {
            background: #f1f1f1;
            color: #777;
        }

        .status-badge.pending {
            background: #fff8d6;
            color: #856404;
        }


        /* ---------- Action Buttons ---------- */

        .admin-action-buttons {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .admin-action-btn {
            width: 32px;
            height: 32px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border: 1px solid #dcdcdc;
            border-radius: 6px;

            background: #ffffff;

            cursor: pointer;

            transition: all 0.2s ease;
        }

        .admin-action-btn i {
            font-size: 12px;
        }

        .admin-action-btn.edit {
            color: #025628;
        }

        .admin-action-btn.edit:hover {
            background: #e8f5e9;
            border-color: #b8d9bf;
        }

        .admin-action-btn.disable {
            color: #777;
        }

        .admin-action-btn.disable:hover {
            background: #f5f5f5;
            border-color: #cfcfcf;
        }


        /* ---------- Empty State ---------- */

        .empty-admins {
            padding: 45px 20px !important;

            text-align: center;

            color: #888 !important;
        }

        .empty-admins i {
            display: block;

            margin-bottom: 10px;

            color: #025628;

            font-size: 28px;
        }

        .empty-admins strong {
            display: block;

            margin-bottom: 4px;

            color: #555;

            font-size: 13px;
        }

        .empty-admins span {
            display: block;

            color: #888;

            font-size: 11px;
        }


        /* ==========================================================
   ADD ADMINISTRATOR MODAL
========================================================== */

        /* ---------- Password Visibility ---------- */

        .password-input-wrapper {
            position: relative;
            width: 100%;
        }

        .password-input-wrapper input {
            padding-right: 42px;
        }

        .password-toggle-btn {
            position: absolute;
            top: 50%;
            right: 10px;

            width: 28px;
            height: 28px;

            display: flex;
            align-items: center;
            justify-content: center;

            transform: translateY(-50%);

            border: none;
            background: transparent;

            color: #777;

            cursor: pointer;
        }

        .password-toggle-btn:hover {
            color: #025628;
        }

        .password-toggle-btn i {
            font-size: 13px;
        }

        .superadmin-modal {
            display: none;

            position: fixed;
            inset: 0;

            align-items: center;
            justify-content: center;

            padding: 20px;

            background: rgba(0, 0, 0, 0.45);

            z-index: 5000;
        }

        .superadmin-modal.open {
            display: flex;
        }

.superadmin-modal-content {
    width: 100%;
    max-width: 650px;
    max-height: 90vh;
    overflow-y: auto;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 15px 45px rgba(0, 0, 0, 0.18);
}


        /* ---------- Modal Header ---------- */

        .superadmin-modal-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;

            gap: 20px;

            padding: 22px 24px;

            border-bottom: 1px solid #eeeeee;
        }

        .superadmin-modal-header h3 {
            margin: 0 0 5px;

            color: #025628;

            font-size: 18px;
        }

        .superadmin-modal-header p {
            margin: 0;

            color: #777;

            font-size: 12px;
        }

        .superadmin-modal-close {
            border: none;

            background: transparent;
            color: #777;

            font-size: 26px;
            line-height: 1;

            cursor: pointer;
        }


        /* ---------- Form ---------- */

        .superadmin-form-grid {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 16px;

            padding: 22px 24px;
        }

        .superadmin-form-group {
            display: flex;
            flex-direction: column;

            gap: 6px;
        }

        .superadmin-form-group label {
            color: #444;

            font-size: 12px;
            font-weight: 700;
        }

        .superadmin-form-group input {
            width: 100%;
            box-sizing: border-box;

            padding: 10px 12px;

            border: 1px solid #dcdcdc;
            border-radius: 7px;

            outline: none;

            font-size: 12px;
            color: #333;
        }

        .superadmin-form-group input:focus {
            border-color: #025628;

            box-shadow:
                0 0 0 2px rgba(2, 86, 40, 0.08);
        }


        /* ---------- Modal Actions ---------- */

        .superadmin-form-actions {
            display: flex;
            justify-content: flex-end;

            gap: 10px;

            padding: 16px 24px;

            border-top: 1px solid #eeeeee;

            background: #fafafa;
        }

        .superadmin-cancel-btn,
        .superadmin-save-btn {
            padding: 10px 16px;

            border-radius: 7px;

            font-size: 12px;
            font-weight: 700;

            cursor: pointer;
        }

        .superadmin-cancel-btn {
            border: 1px solid #d8d8d8;

            background: #ffffff;
            color: #555;
        }

        .superadmin-save-btn {
            border: none;

            background: #025628;
            color: #ffffff;
        }

        .superadmin-save-btn:hover {
            background: #01451f;
        }


        /* ==========================================================
   SUPERADMIN NOTIFICATIONS
========================================================== */

        .notification-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            flex-shrink: 0;
            margin-right: 10px;
        }

        .notification-btn {
            position: relative;
            width: 42px;
            height: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: none;
            background: transparent;

            color: #ffffff;
            font-size: 19px;

            border-radius: 50%;
            cursor: pointer;

            transition: all 0.2s ease;
        }

        .notification-btn:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .notification-badge {
            position: absolute;

            top: 1px;
            right: 0;

            min-width: 17px;
            height: 17px;

            padding: 0 4px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 20px;

            background: #f4d900;
            color: #025628;

            border: 2px solid #025628;

            font-size: 9px;
            font-weight: 800;

            line-height: 1;
        }


        /* ==========================================================
   NOTIFICATION DROPDOWN
========================================================== */

        .notification-dropdown {
            position: absolute;

            top: calc(100% + 12px);
            right: 0;

            width: 360px;
            max-width: calc(100vw - 24px);

            background: #ffffff;

            border-radius: 14px;

            box-shadow:
                0 14px 35px rgba(0, 0, 0, 0.18),
                0 3px 10px rgba(0, 0, 0, 0.08);

            border: 1px solid #e7e7e7;

            overflow: hidden;

            opacity: 0;
            visibility: hidden;

            transform: translateY(-8px);

            transition:
                opacity 0.2s ease,
                transform 0.2s ease,
                visibility 0.2s ease;

            z-index: 3000;
        }

        .notification-dropdown.open {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }


        /* Header */

        .notification-header {
            padding: 17px 18px;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .notification-header h3 {
            margin: 0;

            font-size: 16px;
            font-weight: 800;

            color: #025628;
        }

        .notification-header span {
            display: block;

            margin-top: 3px;

            font-size: 11px;
            color: #888;
        }

        .notification-header-icon {
            color: #025628;
            font-size: 18px;
        }

        .notification-divider {
            height: 1px;
            background: #eeeeee;
        }


        /* Notification List */

        .notification-list {
            max-height: 380px;
            overflow-y: auto;
        }

        .notification-item {
            display: flex;

            align-items: flex-start;

            gap: 12px;

            padding: 13px 16px;

            border-bottom: 1px solid #eeeeee;

            cursor: pointer;

            transition: background 0.2s ease;
        }

        .notification-item:hover {
            background: #f7fbf8;
        }

        .notification-item.notification-unread {
            background: #f7fbf8;
        }

        .notification-item-icon {
            width: 32px;
            height: 32px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #e8f5e9;

            color: #025628;

            font-size: 13px;
        }

        .notification-item-content {
            flex: 1;
            min-width: 0;
        }

        .notification-item-title {
            color: #222;

            font-size: 12px;
            font-weight: 700;

            margin-bottom: 3px;
        }

        .notification-item.notification-unread .notification-item-title {
            font-weight: 800;
        }

        .notification-item-message {
            color: #666;

            font-size: 11px;

            line-height: 1.4;

            margin-bottom: 5px;
        }

        .notification-item-meta {
            color: #aaa;

            font-size: 10px;

            display: flex;
            align-items: center;

            gap: 4px;
        }


        /* Empty State */

        .notification-empty {
            padding: 30px 20px;

            display: flex;
            flex-direction: column;

            align-items: center;
            justify-content: center;

            text-align: center;
        }

        .notification-empty-icon {
            width: 45px;
            height: 45px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #f1f5f2;
            color: #777;

            font-size: 18px;

            margin-bottom: 10px;
        }

        .notification-empty strong {
            font-size: 13px;
            color: #333;
        }

        .notification-empty span {
            margin-top: 4px;

            font-size: 11px;
            color: #888;
        }


        /* Footer */

        .notification-footer {
            padding: 12px 16px;

            border-top: 1px solid #eeeeee;

            background: #fafafa;

            text-align: center;
        }

        .notification-footer a {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            color: #025628;

            font-size: 12px;
            font-weight: 800;

            text-decoration: none;
        }

        .notification-footer a:hover {
            text-decoration: underline;
        }

        .notification-footer i {
            font-size: 10px;
        }


        /* Keep dropdown attached to notification area */

        .topbar-right {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex-wrap: nowrap;
        }

        .topbar-right .avatar-btn {
            flex-shrink: 0;
        }


        /* Mobile */

        @media (max-width: 600px) {

            .notification-dropdown {
                position: fixed;

                top: 70px;
                right: 10px;
                left: 10px;

                width: auto;
                max-width: none;
            }

        }


        /* ==========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 1000px) {

            .superadmin-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .superadmin-dashboard-grid {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 600px) {

            .superadmin-stats {
                grid-template-columns: 1fr;
            }

        }


/* ROLES & PERMISSIONS */

.roles-overview {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
    margin-top: 24px;
}

.role-overview-card {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 22px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    transition: box-shadow 0.2s ease;
}

.role-overview-card:hover {
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.07);
}

.role-overview-icon {
    flex-shrink: 0;
    width: 46px;
    height: 46px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e8f4ec;
    color: #025628;
    border-radius: 10px;
    font-size: 20px;
}

.role-overview-card h4 {
    margin: 2px 0 8px;
    color: #025628;
    font-size: 17px;
}

.role-overview-card p {
    margin: 0 0 12px;
    color: #6b7280;
    font-size: 13px;
    line-height: 1.6;
}

.role-label {
    display: inline-block;
    padding: 5px 9px;
    background: #f0f5f1;
    color: #025628;
    border-radius: 5px;
    font-size: 11px;
    font-weight: 600;
}

@media (max-width: 768px) {
    .roles-overview {
        grid-template-columns: 1fr;
    }
}


.permissions-matrix-section {
    margin-top: 30px;
}

.permissions-matrix-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 18px;
}

.permissions-matrix-header h3 {
    margin: 0 0 6px;
}

.permissions-matrix-header p {
    margin: 0;
    color: #777;
    font-size: 14px;
}

.view-only-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 8px 12px;
    border-radius: 20px;
    background: #f1f3f5;
    color: #495057;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
}


.permissions-table-wrapper {
    width: 100%;
    max-width: 100%;
    overflow-x: auto;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
}

.permissions-table {
    width: 100%;
    min-width: 1000px;
    border-collapse: collapse;
    table-layout: auto;
    font-size: 13px;
}


.permissions-table th,
.permissions-table td {
    padding: 14px 16px;
    text-align: left;
    vertical-align: middle;
    border-bottom: 1px solid #e5e7eb;
}

.permissions-table thead th {
    background: #f8fafc;
    color: #374151;
    font-weight: 600;
    white-space: nowrap;
}

.permissions-table tbody tr:last-child td {
    border-bottom: none;
}

.permissions-table tbody tr:hover {
    background: #fafafa;
}

.permission-yes {
    color: #18794e;
    font-weight: 600;
}

.permission-no {
    color: #9ca3af;
    text-align: center !important;
}

.permission-review {
    color: #946200;
    font-weight: 500;
}

.permissions-matrix-note {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    margin: 14px 0 0;
    color: #6b7280;
    font-size: 12px;
    line-height: 1.6;
}

.permissions-matrix-note i {
    margin-top: 3px;
}

@media (max-width: 768px) {
    .permissions-matrix-header {
        align-items: flex-start;
        flex-direction: column;
    }
}

.permissions-table td {
    max-width: 220px;
    white-space: normal;
    line-height: 1.5;
}

.permissions-table th:first-child,
.permissions-table td:first-child {
    width: 250px;
}


/* SYSTEM SETTINGS */

.system-settings-overview {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
    margin-top: 24px;
}

.system-setting-card {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 22px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    transition: box-shadow 0.2s ease;
}

.system-setting-card:hover {
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.07);
}

.system-setting-icon {
    flex-shrink: 0;
    width: 46px;
    height: 46px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e8f4ec;
    color: #025628;
    border-radius: 10px;
    font-size: 20px;
}

.system-setting-content {
    min-width: 0;
}

.system-setting-content h4 {
    margin: 2px 0 8px;
    color: #025628;
    font-size: 16px;
}

.system-setting-content p {
    margin: 0 0 12px;
    color: #6b7280;
    font-size: 13px;
    line-height: 1.6;
}

.system-setting-status {
    display: inline-block;
    padding: 5px 9px;
    background: #f0f5f1;
    color: #025628;
    border-radius: 5px;
    font-size: 11px;
    font-weight: 600;
}

.system-settings-note {
    display: flex;
    align-items: flex-start;
    gap: 9px;
    margin-top: 20px;
    padding: 14px 16px;
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    color: #6b7280;
    font-size: 12px;
    line-height: 1.6;
}

.system-settings-note i {
    margin-top: 3px;
}

@media (max-width: 768px) {
    .system-settings-overview {
        grid-template-columns: 1fr;
    }
}


/* SYSTEM CONFIGURATION */

.system-configuration-overview {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
    margin-top: 24px;
}

.system-configuration-card {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 22px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    transition: box-shadow 0.2s ease;
}

.system-configuration-card:hover {
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.07);
}

.system-configuration-icon {
    flex-shrink: 0;
    width: 46px;
    height: 46px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e8f4ec;
    color: #025628;
    border-radius: 10px;
    font-size: 20px;
}

.system-configuration-content {
    min-width: 0;
}

.system-configuration-content h4 {
    margin: 2px 0 8px;
    color: #025628;
    font-size: 16px;
}

.system-configuration-content p {
    margin: 0 0 12px;
    color: #6b7280;
    font-size: 13px;
    line-height: 1.6;
}

.system-configuration-status {
    display: inline-block;
    padding: 5px 9px;
    background: #f0f5f1;
    color: #025628;
    border-radius: 5px;
    font-size: 11px;
    font-weight: 600;
}

.system-configuration-note {
    display: flex;
    align-items: flex-start;
    gap: 9px;
    margin-top: 20px;
    padding: 14px 16px;
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    color: #6b7280;
    font-size: 12px;
    line-height: 1.6;
}

.system-configuration-note i {
    margin-top: 3px;
}

@media (max-width: 768px) {
    .system-configuration-overview {
        grid-template-columns: 1fr;
    }
}


/* USER ACTIVITY LOGS */

.activity-logs-overview {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
    margin-top: 24px;
}

.activity-summary-card {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 22px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    transition: box-shadow 0.2s ease;
}

.activity-summary-card:hover {
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.07);
}

.activity-summary-icon {
    flex-shrink: 0;
    width: 46px;
    height: 46px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e8f4ec;
    color: #025628;
    border-radius: 10px;
    font-size: 20px;
}

.activity-summary-card h4 {
    margin: 2px 0 8px;
    color: #025628;
    font-size: 16px;
}

.activity-summary-card p {
    margin: 0 0 12px;
    color: #6b7280;
    font-size: 13px;
    line-height: 1.6;
}

.activity-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 9px;
    background: #f0f5f1;
    color: #025628;
    border-radius: 5px;
    font-size: 11px;
    font-weight: 600;
}

.activity-log-table-section {
    margin-top: 30px;
}

.activity-log-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 18px;
}

.activity-log-header h3 {
    margin: 0 0 6px;
}

.activity-log-header p {
    margin: 0;
    color: #777;
    font-size: 14px;
}

.activity-log-table-wrapper {
    width: 100%;
    overflow-x: auto;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
}

.activity-log-table {
    width: 100%;
    min-width: 750px;
    border-collapse: collapse;
    font-size: 13px;
}

.activity-log-table th,
.activity-log-table td {
    padding: 14px 16px;
    text-align: left;
    vertical-align: middle;
    border-bottom: 1px solid #e5e7eb;
}

.activity-log-table thead th {
    background: #f8fafc;
    color: #374151;
    font-weight: 600;
    white-space: nowrap;
}

.activity-log-table tbody tr:last-child td {
    border-bottom: none;
}

.activity-empty-state {
    height: 150px;
    text-align: center !important;
    color: #6b7280;
}

.activity-empty-state i,
.activity-empty-state strong,
.activity-empty-state span {
    display: block;
}

.activity-empty-state i {
    margin-bottom: 10px;
    font-size: 24px;
    color: #025628;
}

.activity-empty-state strong {
    margin-bottom: 6px;
    color: #374151;
}

.activity-empty-state span {
    font-size: 12px;
}

.activity-logs-note {
    display: flex;
    align-items: flex-start;
    gap: 9px;
    margin-top: 20px;
    padding: 14px 16px;
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    color: #6b7280;
    font-size: 12px;
    line-height: 1.6;
}

.activity-logs-note i {
    margin-top: 3px;
}

@media (max-width: 768px) {
    .activity-logs-overview {
        grid-template-columns: 1fr;
    }

    .activity-log-header {
        align-items: flex-start;
        flex-direction: column;
    }
}


    </style>

</head>


<body>


    <!-- ==========================================================
     TOPBAR
========================================================== -->

    <nav class="topbar">

        <div class="topbar-left">

            <button class="hamburger" id="hamburger" aria-label="Toggle sidebar">

                <span></span>
                <span></span>
                <span></span>

            </button>


            <a href="{{ route('superadmin.dashboard') }}" class="topbar-brand">

                <img src="{{ asset('images/logo.png') }}" alt="LEDIPO Logo" class="topbar-logo">

                <span>LEDIPO</span>

            </a>

        </div>


        <div class="topbar-right">


            <!-- ==================================================
             NOTIFICATION
        =================================================== -->

            <div class="notification-wrapper" id="notificationWrapper">

                <button type="button" class="notification-btn" id="notificationBtn" aria-label="Open notifications"
                    aria-expanded="false">

                    <i class="fa-solid fa-bell"></i>


                    @php

                        $notificationAllAnnouncements =
                            \App\Models\Announcement::where(
                                'is_active',
                                1
                            )
                                ->latest()
                                ->get();

                        $notificationReadIds =
                            \DB::table('announcement_reads')
                                ->where(
                                    'user_id',
                                    \Auth::id()
                                )
                                ->whereIn(
                                    'announcement_id',
                                    $notificationAllAnnouncements->pluck('id')
                                )
                                ->pluck('announcement_id')
                                ->toArray();

                        $notificationLatest =
                            $notificationAllAnnouncements->take(5);

                        $notificationUnread =
                            $notificationAllAnnouncements
                                ->whereNotIn(
                                    'id',
                                    $notificationReadIds
                                );

                        $notificationAnnouncements =
                            $notificationLatest
                                ->concat($notificationUnread)
                                ->unique('id')
                                ->sortByDesc('created_at')
                                ->values();

                        $notificationCount =
                            $notificationUnread->count();

                    @endphp


                    @if($notificationCount > 0)

                        <span class="notification-badge">
                            {{ $notificationCount > 99 ? '99+' : $notificationCount }}
                        </span>

                    @endif

                </button>


                <!-- Notification Dropdown -->

                <div class="notification-dropdown" id="notificationDropdown">

                    <div class="notification-header">

                        <div>

                            <h3>Notifications</h3>

                            <span>
                                {{ $notificationCount }}
                                unread notification{{ $notificationCount != 1 ? 's' : '' }}
                            </span>

                        </div>

                        <i class="fa-solid fa-bell notification-header-icon"></i>

                    </div>


                    <div class="notification-divider"></div>


                    <div class="notification-list">

                        @forelse(
                                $notificationAnnouncements
                                as $announcement
                            )

                            <div class="notification-item {{ in_array($announcement->id, $notificationReadIds, true) ? '' : 'notification-unread' }}"
                                data-announcement-id="{{ $announcement->id }}"
                                data-read="{{ in_array($announcement->id, $notificationReadIds, true) ? '1' : '0' }}"
                                role="button" tabindex="0">

                                <div class="notification-item-icon
                                    notification-type-{{ strtolower($announcement->type) }}">

                                    @if($announcement->type === 'urgent')

                                        <i class="fa-solid fa-circle-exclamation"></i>

                                    @elseif($announcement->type === 'notice')

                                        <i class="fa-solid fa-bullhorn"></i>

                                    @else

                                        <i class="fa-solid fa-bell"></i>

                                    @endif

                                </div>


                                <div class="notification-item-content">

                                    <div class="notification-item-title">
                                        {{ $announcement->title }}
                                    </div>

                                    <div class="notification-item-message">
                                        {{ $announcement->message }}
                                    </div>

                                    <div class="notification-item-meta">

                                        <i class="fa-regular fa-clock"></i>

                                        {{ $announcement->created_at->diffForHumans() }}

                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="notification-empty">

                                <div class="notification-empty-icon">

                                    <i class="fa-solid fa-bell-slash"></i>

                                </div>

                                <strong>No notifications</strong>

                                <span>
                                    You're all caught up.
                                </span>

                            </div>

                        @endforelse

                    </div>


                    <div class="notification-footer">

                        <a href="{{ route('admin1') }}?view=announcements">

                            View All Announcements

                            <i class="fa-solid fa-arrow-right"></i>

                        </a>

                    </div>

                </div>

            </div>


            <!-- ==================================================
             PROFILE
        =================================================== -->

            @php

                $superAdminUser = \Auth::user();

                $superAdminName =
                    trim(
                        ($superAdminUser->firstname ?? '') .
                        ' ' .
                        ($superAdminUser->lastname ?? '')
                    );

                $superAdminName =
                    $superAdminName !== ''
                    ? $superAdminName
                    : 'Super Admin';

                $nameParts =
                    preg_split(
                        '/\s+/',
                        $superAdminName
                    );

                $superAdminInitials =
                    strtoupper(
                        substr($nameParts[0] ?? 'S', 0, 1) .
                        substr(
                            $nameParts[count($nameParts) - 1] ?? 'A',
                            0,
                            1
                        )
                    );

            @endphp


            <button class="avatar-btn" id="avatarBtn" aria-label="Open profile menu">

                {{ $superAdminInitials }}

            </button>


            <div class="dropdown" id="dropdown">

                <div class="dropdown-header">

                    <div class="dh-name">
                        {{ $superAdminName }}
                    </div>

                    <div class="dh-role">
                        SuperAdmin
                    </div>

                </div>


                <div class="dd-divider"></div>


                <a href="#" class="dd-item" onclick="showView('profile'); return false;">

                    <i class="fa fa-user dd-icon"></i>

                    My Profile

                </a>


                <a href="#" class="dd-item dd-logout" onclick="
                    event.preventDefault();
                    openLogoutModal();
                ">

                    <i class="fa fa-right-from-bracket dd-icon"></i>

                    Log out

                </a>


                <form id="logout-form" action="{{ route('Logout') }}" method="POST" style="display:none;">

                    @csrf

                </form>

            </div>

        </div>

    </nav>



    <!-- ==========================================================
     LOGOUT MODAL
========================================================== -->

    <div id="logoutModal" class="modal" style="display:none;">

        <div class="modal-content">

            <div class="modal-header">

                <h3>
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Confirm Logout
                </h3>

                <span class="close-modal" onclick="closeLogoutModal()">

                    &times;

                </span>

            </div>


            <div style="
                padding:24px;
                text-align:center;
            ">

                <p style="
                    margin:0;
                    font-size:14px;
                    color:#333;
                ">

                    Are you sure you want to log out?

                </p>

            </div>


            <div class="modal-actions-centered" style="
                display:flex;
                justify-content:center;
                gap:10px;
                padding-bottom:18px;
            ">

                <button onclick="confirmLogout()" class="btn-modal-yes">

                    Yes

                </button>


                <button onclick="closeLogoutModal()" class="btn-modal-no">

                    Cancel

                </button>

            </div>

        </div>

    </div>



    <!-- ==========================================================
     APPLICATION BODY
========================================================== -->

    <div class="app-body">


        <!-- Mobile Overlay -->

        <div class="sidebar-overlay" id="overlay">
        </div>


        <!-- ======================================================
         SIDEBAR
    ======================================================= -->

        <aside class="sidebar" id="sidebar">


            <div class="sidebar-section-label">
                Menu
            </div>


            <a href="#dashboard" class="nav-item active" data-view="dashboard" onclick="
                showView('dashboard');
                return false;
            ">

                <i class="fa fa-house nav-icon"></i>

                <span>Dashboard</span>

            </a>



            <div class="sidebar-section-label">
                User Management
            </div>


            <a href="#admin-accounts" class="nav-item" data-view="admin-accounts" onclick="
                showView('admin-accounts');
                return false;
            ">

                <i class="fa fa-user-shield nav-icon"></i>

                <span>Admin Accounts</span>

            </a>


            <a href="#trainer-accounts" class="nav-item" data-view="trainer-accounts" onclick="
                showView('trainer-accounts');
                return false;
            ">

                <i class="fa fa-chalkboard-user nav-icon"></i>

                <span>Trainer Accounts</span>

            </a>


            <a href="#student-accounts" class="nav-item" data-view="student-accounts" onclick="
                showView('student-accounts');
                return false;
            ">

                <i class="fa fa-users nav-icon"></i>

                <span>Student Accounts</span>

            </a>



            <div class="sidebar-section-label">
                Access & Permissions
            </div>


            <a href="#roles-permissions" class="nav-item" data-view="roles-permissions" onclick="
                showView('roles-permissions');
                return false;
            ">

                <i class="fa fa-key nav-icon"></i>

                <span>Roles &amp; Permissions</span>

            </a>



            <div class="sidebar-section-label">
                System Management
            </div>


            <a href="#system-settings" class="nav-item" data-view="system-settings" onclick="
                showView('system-settings');
                return false;
            ">

                <i class="fa fa-gear nav-icon"></i>

                <span>System Settings</span>

            </a>


            <a href="#system-configuration" class="nav-item" data-view="system-configuration" onclick="
                showView('system-configuration');
                return false;
            ">

                <i class="fa fa-sliders nav-icon"></i>

                <span>System Configuration</span>

            </a>



            <div class="sidebar-section-label">
                Audit &amp; Logs
            </div>


            <a href="#user-activity" class="nav-item" data-view="user-activity" onclick="
                showView('user-activity');
                return false;
            ">

                <i class="fa fa-user-clock nav-icon"></i>

                <span>User Activity Logs</span>

            </a>


            <a href="#system-logs" class="nav-item" data-view="system-logs" onclick="
                showView('system-logs');
                return false;
            ">

                <i class="fa fa-file-lines nav-icon"></i>

                <span>System Logs</span>

            </a>


        </aside>



        <!-- ======================================================
         MAIN CONTENT
    ======================================================= -->

        <main class="admin-main">


            <!-- Breadcrumb -->

            <nav class="breadcrumb">

                <a href="#dashboard" onclick="
                    showView('dashboard');
                    return false;
                ">

                    Home

                </a>

                /

                <span id="breadcrumb-current">
                    SuperAdmin Dashboard
                </span>

            </nav>



            <!-- ==================================================
             DASHBOARD VIEW
        =================================================== -->

            <div id="view-dashboard" class="superadmin-view">


                <h1 class="page-title" id="main-title">

                    SuperAdmin Dashboard

                </h1>


                <p style="
                    color:#777;
                    font-size:13px;
                    margin:-10px 0 20px;
                ">

                    System-wide overview and administrative controls.

                </p>



                <!-- ==============================================
                 STATISTICS
            =============================================== -->

                <div class="superadmin-stats">


                    <!-- Total Admins -->

                    <div class="superadmin-stat-card">

                        <div class="superadmin-stat-icon">

                            <i class="fa-solid fa-user-shield"></i>

                        </div>

                        <div class="superadmin-stat-info">

                            <small>Total Admins</small>

                            <strong>3</strong>

                        </div>

                    </div>


                    <!-- Total Trainers -->

                    <div class="superadmin-stat-card">

                        <div class="superadmin-stat-icon">

                            <i class="fa-solid fa-chalkboard-user"></i>

                        </div>

                        <div class="superadmin-stat-info">

                            <small>Total Trainers</small>

                            <strong>8</strong>

                        </div>

                    </div>


                    <!-- Total Students -->

                    <div class="superadmin-stat-card">

                        <div class="superadmin-stat-icon">

                            <i class="fa-solid fa-users"></i>

                        </div>

                        <div class="superadmin-stat-info">

                            <small>Total Students</small>

                            <strong>245</strong>

                        </div>

                    </div>


                    <!-- Total Users -->

                    <div class="superadmin-stat-card">

                        <div class="superadmin-stat-icon">

                            <i class="fa-solid fa-user-group"></i>

                        </div>

                        <div class="superadmin-stat-info">

                            <small>Total Users</small>

                            <strong>256</strong>

                        </div>

                    </div>


                </div>



                <!-- ==============================================
                 DASHBOARD GRID
            =============================================== -->

                <div class="superadmin-dashboard-grid">


                    <!-- USER DISTRIBUTION -->

                    <div class="superadmin-card">

                        <div class="superadmin-card-header">

                            <h3>
                                <i class="fa-solid fa-chart-simple" style="margin-right:7px;">
                                </i>

                                User Distribution

                            </h3>

                            <span>
                                Current overview
                            </span>

                        </div>


                        <!-- Admin -->

                        <div class="distribution-row">

                            <div class="distribution-label">

                                <span>Administrators</span>

                                <strong>3</strong>

                            </div>

                            <div class="distribution-bar">

                                <div class="distribution-fill" style="width:12%;">
                                </div>

                            </div>

                        </div>


                        <!-- Trainers -->

                        <div class="distribution-row">

                            <div class="distribution-label">

                                <span>Trainers</span>

                                <strong>8</strong>

                            </div>

                            <div class="distribution-bar">

                                <div class="distribution-fill" style="width:18%;">
                                </div>

                            </div>

                        </div>


                        <!-- Students -->

                        <div class="distribution-row">

                            <div class="distribution-label">

                                <span>Students / Trainees</span>

                                <strong>245</strong>

                            </div>

                            <div class="distribution-bar">

                                <div class="distribution-fill" style="width:95%;">
                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- RECENT ACTIVITY -->

                    <div class="superadmin-card">

                        <div class="superadmin-card-header">

                            <h3>
                                <i class="fa-solid fa-clock-rotate-left" style="margin-right:7px;">
                                </i>

                                Recent Activity

                            </h3>

                        </div>


                        <div class="activity-item">

                            <div class="activity-icon">

                                <i class="fa-solid fa-user-plus"></i>

                            </div>

                            <div class="activity-content">

                                <strong>
                                    New administrator account
                                </strong>

                                <small>
                                    Recently added
                                </small>

                            </div>

                        </div>


                        <div class="activity-item">

                            <div class="activity-icon">

                                <i class="fa-solid fa-key"></i>

                            </div>

                            <div class="activity-content">

                                <strong>
                                    Permission settings updated
                                </strong>

                                <small>
                                    System access
                                </small>

                            </div>

                        </div>


                        <div class="activity-item">

                            <div class="activity-icon">

                                <i class="fa-solid fa-right-to-bracket"></i>

                            </div>

                            <div class="activity-content">

                                <strong>
                                    Administrator logged in
                                </strong>

                                <small>
                                    Recent system activity
                                </small>

                            </div>

                        </div>


                    </div>

                </div>


            </div>



            <!-- ==========================================================
     ADMIN ACCOUNTS
========================================================== -->

            <div id="view-admin-accounts" class="superadmin-view" style="display:none;">

                <h1 class="page-title">
                    Admin Accounts
                </h1>


                <!-- ADMIN ACCOUNTS CARD -->

                <div class="superadmin-page-card">

                    <!-- HEADER -->

                    <div class="admin-accounts-header">

                        <div>

                            <h3>
                                Manage Administrator Accounts
                            </h3>

                            <p>
                                Create, update, disable, and manage administrator
                                accounts from this section.
                            </p>

                        </div>


                        <button type="button" class="superadmin-add-btn" onclick="openAddAdminModal()">

                            <i class="fa-solid fa-plus"></i>

                            Add Administrator

                        </button>

                    </div>


                    <!-- ADMINISTRATOR TABLE -->

                    <div class="superadmin-table-wrapper">

                        <table class="superadmin-table">

                            <thead>

                                <tr>

                                    <th>
                                        Administrator
                                    </th>

                                    <th>
                                        Email
                                    </th>

                                    <th>
                                        Username
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th>
                                        Date Created
                                    </th>

                                    <th>
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse($admins as $admin)

                                    <tr>

                                        <!-- Administrator -->

                                        <td>

                                            <div class="admin-user-cell">

                                                <div class="admin-user-avatar">

                                                    {{ strtoupper(substr($admin->firstname, 0, 1)) }}{{ strtoupper(substr($admin->lastname, 0, 1)) }}

                                                </div>


                                                <div>

                                                    <strong>
                                                        {{ $admin->firstname }}
                                                        {{ $admin->lastname }}
                                                    </strong>

                                                </div>

                                            </div>

                                        </td>


                                        <!-- Email -->

                                        <td>
                                            {{ $admin->email }}
                                        </td>


                                        <!-- Username -->

                                        <td>
                                            {{ $admin->username }}
                                        </td>


                                        <!-- Status -->

                                        <td>

                                            @php
                                                $status = strtolower(
                                                    $admin->status ?? 'inactive'
                                                );
                                            @endphp

                                            <span class="status-badge {{ $status }}">
                                                {{ ucfirst($status) }}
                                            </span>

                                        </td>


                                        <!-- Date Created -->

                                        <td>

                                            {{ $admin->created_at?->format('M d, Y') ?? 'N/A' }}

                                        </td>


                                        <!-- Actions -->

                                        <td>

                                            <div class="admin-action-buttons">

                                                <button type="button" class="admin-action-btn edit"
                                                    title="Edit Administrator" onclick="openEditAdminModal(
                                        {{ $admin->id }},
                                        @js($admin->firstname),
                                        @js($admin->lastname),
                                        @js($admin->email),
                                        @js($admin->username)
                                    )">
                                                    <i class="fa-solid fa-pen"></i>
                                                </button>


                                                <button type="button" class="admin-action-btn disable"
                                                    title="Disable Administrator">

                                                    <i class="fa-solid fa-user-slash"></i>

                                                </button>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="6" class="empty-admins">

                                            <i class="fa-solid fa-user-shield"></i>

                                            <strong>
                                                No administrator accounts found.
                                            </strong>

                                            <span>
                                                There are currently no users with the
                                                Admin role.
                                            </span>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>


            <!-- ==========================================================
     ADD ADMINISTRATOR MODAL
========================================================== -->

            <div id="addAdminModal" class="superadmin-modal">

                <div class="superadmin-modal-content">


                    <!-- MODAL HEADER -->

                    <div class="superadmin-modal-header">

                        <div>

                            <h3>
                                Add Administrator
                            </h3>

                            <p>
                                Create a new administrator account.
                            </p>

                        </div>


                        <button type="button" class="superadmin-modal-close" onclick="closeAddAdminModal()">

                            &times;

                        </button>

                    </div>


                    <!-- FORM -->

                    <form method="POST" action="{{ route('superadmin.admin.store') }}">

                        @csrf


                        <div class="superadmin-form-grid">

                            <!-- First Name -->

                            <div class="superadmin-form-group">

                                <label for="admin_firstname">
                                    First Name
                                </label>

                                <input type="text" id="admin_firstname" name="firstname" required>

                            </div>


                            <!-- Last Name -->

                            <div class="superadmin-form-group">

                                <label for="admin_lastname">
                                    Last Name
                                </label>

                                <input type="text" id="admin_lastname" name="lastname" required>

                            </div>


                            <!-- Email -->

                            <div class="superadmin-form-group">

                                <label for="admin_email">
                                    Email
                                </label>

                                <input type="email" id="admin_email" name="email" required>

                            </div>


                            <!-- Username -->

                            <div class="superadmin-form-group">

                                <label for="admin_username">
                                    Username
                                </label>

                                <input type="text" id="admin_username" name="username" required>

                            </div>


                            <!-- Password -->

                            <div class="superadmin-form-group">

                                <label for="admin_password">
                                    Password
                                </label>

                                <div class="password-input-wrapper">

                                    <input type="password" id="admin_password" name="password" required>

                                    <button type="button" class="password-toggle-btn"
                                        onclick="togglePasswordVisibility('admin_password', 'adminPasswordIcon')"
                                        title="Show password">
                                        <i id="adminPasswordIcon" class="fa-solid fa-eye"></i>
                                    </button>

                                </div>

                            </div>


                            <!-- Confirm Password -->

                            <div class="superadmin-form-group">

                                <label for="admin_password_confirmation">
                                    Confirm Password
                                </label>

                                <div class="password-input-wrapper">

                                    <input type="password" id="admin_password_confirmation" name="password_confirmation"
                                        required>

                                    <button type="button" class="password-toggle-btn"
                                        onclick="togglePasswordVisibility('admin_password_confirmation', 'adminConfirmPasswordIcon')"
                                        title="Show password">
                                        <i id="adminConfirmPasswordIcon" class="fa-solid fa-eye"></i>
                                    </button>

                                </div>

                            </div>


                            <!-- FORM ACTIONS -->

                            <div class="superadmin-form-actions">

                                <button type="button" class="superadmin-cancel-btn" onclick="closeAddAdminModal()">

                                    Cancel

                                </button>


                                <button type="submit" class="superadmin-save-btn">

                                    <i class="fa-solid fa-user-plus"></i>

                                    Create Administrator

                                </button>

                            </div>


                        </div> <!-- Close superadmin-form-grid -->

                    </form>

                </div> <!-- Close superadmin-modal-content -->

            </div> <!-- Close addAdminModal -->


            <!-- ==========================================================
     EDIT ADMINISTRATOR MODAL
========================================================== -->

            <div id="editAdminModal" class="superadmin-modal">
                <div class="superadmin-modal-content">

                    <div class="superadmin-modal-header">
                        <div>
                            <h3>Edit Administrator</h3>
                            <p>Update administrator account information.</p>
                        </div>

                        <button type="button" class="superadmin-modal-close" onclick="closeEditAdminModal()">
                            &times;
                        </button>
                    </div>

                    <form id="editAdminForm" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="superadmin-form-grid">

                            <div class="superadmin-form-group">
                                <label for="edit_admin_firstname">First Name</label>
                                <input type="text" id="edit_admin_firstname" name="firstname" required>
                            </div>

                            <div class="superadmin-form-group">
                                <label for="edit_admin_lastname">Last Name</label>
                                <input type="text" id="edit_admin_lastname" name="lastname" required>
                            </div>

                            <div class="superadmin-form-group">
                                <label for="edit_admin_email">Email</label>
                                <input type="email" id="edit_admin_email" name="email" required>
                            </div>

                            <div class="superadmin-form-group">
                                <label for="edit_admin_username">Username</label>
                                <input type="text" id="edit_admin_username" name="username" required>
                            </div>

                            <div class="superadmin-form-group">
                                <label for="edit_admin_password">
                                    New Password (Optional)
                                </label>
                                <input type="password" id="edit_admin_password" name="password" minlength="8"
                                    autocomplete="new-password">
                            </div>

                            <div class="superadmin-form-group">
                                <label for="edit_admin_password_confirmation">
                                    Confirm New Password
                                </label>
                                <input type="password" id="edit_admin_password_confirmation"
                                    name="password_confirmation" minlength="8" autocomplete="new-password">
                            </div>

                        </div>

                        <div class="superadmin-form-actions">
                            <button type="button" class="superadmin-cancel-btn" onclick="closeEditAdminModal()">
                                Cancel
                            </button>

                            <button type="submit" class="superadmin-save-btn">
                                <i class="fa-solid fa-floppy-disk"></i>
                                Save Changes
                            </button>
                        </div>
                    </form>

                </div>
            </div>


<!-- ==========================================================
     TRAINER ACCOUNTS
========================================================== -->

<div id="view-trainer-accounts" class="superadmin-view" style="display:none;">

    <h1 class="page-title">
        Trainer Accounts
    </h1>

    <!-- TRAINER ACCOUNTS CARD -->

    <div class="superadmin-page-card">

        <!-- HEADER -->

<div class="admin-accounts-header">

    <div>
        <h3>
            Manage Trainer Accounts
        </h3>

        <p>
            View and manage trainer accounts from this section.
        </p>
    </div>

    <button type="button"
        class="superadmin-add-btn"
        onclick="openAddTrainerModal()">

        <i class="fa-solid fa-plus"></i>

        Add Trainer

    </button>

</div>

        <!-- TRAINER TABLE -->

        <div class="superadmin-table-wrapper">

            <table class="superadmin-table">

                <thead>
                    <tr>
                        <th>Trainer</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Date Created</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($trainers as $trainer)

                        <tr>

                            <!-- Trainer -->

                            <td>
                                <div class="admin-user-cell">

                                    <div class="admin-user-avatar">
                                        {{ strtoupper(substr($trainer->firstname, 0, 1)) }}{{ strtoupper(substr($trainer->lastname, 0, 1)) }}
                                    </div>

                                    <div>
                                        <strong>
                                            {{ $trainer->firstname }}
                                            {{ $trainer->lastname }}
                                        </strong>
                                    </div>

                                </div>
                            </td>

                            <!-- Email -->

                            <td>
                                {{ $trainer->email }}
                            </td>

                            <!-- Username -->

                            <td>
                                {{ $trainer->username }}
                            </td>

                            <!-- Status -->

                            <td>
                                @php
                                    $status = strtolower($trainer->status ?? 'inactive');
                                @endphp

                                <span class="status-badge {{ $status }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            <!-- Date Created -->

                            <td>
                                {{ $trainer->created_at?->format('M d, Y') ?? 'N/A' }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="empty-admins">

                                <i class="fa-solid fa-chalkboard-user"></i>

                                <strong>
                                    No trainer accounts found.
                                </strong>

                                <span>
                                    There are currently no users with the
                                    Trainer role.
                                </span>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div> {{-- End superadmin-table-wrapper --}}

    </div> {{-- End superadmin-page-card --}}

</div> {{-- End view-trainer-accounts --}}


<!-- ADD TRAINER MODAL -->
<div id="addTrainerModal" class="superadmin-modal">

    <div class="superadmin-modal-content">

        <div class="superadmin-modal-header">
            <h3>Add Trainer</h3>

        <button type="button"
            class="superadmin-modal-close"
            onclick="closeAddTrainerModal()"
            aria-label="Close">
            &times;
        </button>
        </div>

        <form id="addTrainerForm"
              method="POST"
              action="{{ route('superadmin.trainers.store') }}">

            @csrf

            <div class="superadmin-form-grid">

                <div class="superadmin-form-group">
                    <label for="trainerFirstname">First Name</label>
                    <input type="text"
                        id="trainerFirstname"
                        name="firstname"
                        required>
                </div>

                <div class="superadmin-form-group">
                    <label for="trainerLastname">Last Name</label>
                    <input type="text"
                        id="trainerLastname"
                        name="lastname"
                        required>
                </div>

                <div class="superadmin-form-group">
                    <label for="trainerEmail">Email</label>
                    <input type="email"
                        id="trainerEmail"
                        name="email"
                        required>
                </div>

                <div class="superadmin-form-group">
                    <label for="trainerUsername">Username</label>
                    <input type="text"
                        id="trainerUsername"
                        name="username"
                        required>
                </div>

                <div class="superadmin-form-group">
                    <label for="trainerPassword">Password</label>
                    <input type="password"
                        id="trainerPassword"
                        name="password"
                        minlength="8"
                        required>
                </div>

                <div class="superadmin-form-group">
                    <label for="trainerPasswordConfirmation">
                        Confirm Password
                    </label>
                    <input type="password"
                        id="trainerPasswordConfirmation"
                        name="password_confirmation"
                        minlength="8"
                        required>
                </div>

            </div>


            <div class="superadmin-form-actions">

                <button type="button"
                    class="superadmin-cancel-btn"
                    onclick="closeAddTrainerModal()">
                    Cancel
                </button>

                <button type="submit"
                    class="superadmin-save-btn">
                    Create Trainer
                </button>

            </div>

        </form>

    </div>

</div>






            <!-- ==================================================
             STUDENT ACCOUNTS
        =================================================== -->

            <div id="view-student-accounts" class="superadmin-view" style="display:none;">

                <h1 class="page-title">
                    Student Accounts
                </h1>

                <div class="superadmin-page-card">

                    <h3>
                        Student / Trainee Accounts
                    </h3>

                    <p>
                        View and manage registered trainees and student accounts.
                    </p>


<!-- STUDENT SEARCH AND FILTER -->
<div class="student-filter-bar" style="
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 18px;
    align-items: center;
">
    <div style="
        position: relative;
        flex: 1;
        min-width: 220px;
    ">
        <i class="fa-solid fa-magnifying-glass" style="
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        "></i>

        <input
            type="text"
            id="studentSearchInput"
            placeholder="Search by name, email, or username..."
            style="
                width: 100%;
                box-sizing: border-box;
                padding: 11px 12px 11px 36px;
                border: 1px solid #dcdcdc;
                border-radius: 7px;
                font-size: 12px;
                outline: none;
            "
        >
    </div>

    <select
        id="studentStatusFilter"
        style="
            min-width: 160px;
            padding: 11px 12px;
            border: 1px solid #dcdcdc;
            border-radius: 7px;
            background: #fff;
            color: #444;
            font-size: 12px;
        "
    >
        <option value="">All Statuses</option>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>
</div>



<div class="superadmin-table-wrapper">

    <table class="superadmin-table">
        <thead>
            <tr>
                <th>STUDENT NAME</th>
                <th>EMAIL</th>
                <th>USERNAME</th>
                <th>STATUS</th>
                <th>DATE CREATED</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>
                        {{ $student->firstname }}
                        {{ $student->lastname }}
                    </td>

                    <td>{{ $student->email }}</td>

                    <td>{{ $student->username }}</td>

                    <td>
                        @php
                            $status = strtolower(
                                $student->status ?? 'inactive'
                            );
                        @endphp

                        <span class="status-badge {{ $status }}">
                            {{ ucfirst($status) }}
                        </span>
                    </td>

                    <td>
                        {{ $student->created_at?->format('M d, Y') ?? 'N/A' }}
                    </td>


<td>
    <button
        type="button"
        class="student-view-btn"
        onclick="viewStudentDetails(
            {{ $student->id }},
            @js($student->firstname),
            @js($student->lastname),
            @js($student->email),
            @js($student->username),
            @js($student->status ?? 'Inactive'),
            @js($student->created_at?->format('M d, Y') ?? 'N/A'),
            @js($student->contact ?? 'Not provided'),
            @js($student->role)
        )"
        style="
            padding: 7px 12px;
            background: #025628;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        "
    >
        <i class="fa-solid fa-eye"></i> View
    </button>
</td>


                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty-admins">
                        <i class="fa-solid fa-users"></i>

                        <strong>No student accounts found.</strong>

                        <span>
                            No accounts with the student role were found.
                        </span>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>


                </div>

            </div>



            <!-- ==================================================
             ROLES & PERMISSIONS
        =================================================== -->

            <div id="view-roles-permissions" class="superadmin-view" style="display:none;">

                <h1 class="page-title">
                    Roles &amp; Permissions
                </h1>

                <div class="superadmin-page-card">

                    <h3>
                        Access &amp; Permissions
                    </h3>

                    <p>
                        Manage system roles and determine which functions
                        each role can access.
                    </p>


<div class="roles-overview">

    <div class="role-overview-card">
        <div class="role-overview-icon">
            <i class="fa-solid fa-shield-halved"></i>
        </div>
        <div>
            <h4>Super Admin</h4>
            <p>System administration and overall access management.</p>
            <span class="role-label">Highest Access</span>
        </div>
    </div>

    <div class="role-overview-card">
        <div class="role-overview-icon">
            <i class="fa-solid fa-user-gear"></i>
        </div>
        <div>
            <h4>Admin</h4>
            <p>Administrative functions and management of assigned system records.</p>
            <span class="role-label">Administrative Access</span>
        </div>
    </div>

    <div class="role-overview-card">
        <div class="role-overview-icon">
            <i class="fa-solid fa-chalkboard-user"></i>
        </div>
        <div>
            <h4>Trainer</h4>
            <p>Training-related functions and management of assigned trainees.</p>
            <span class="role-label">Training Access</span>
        </div>
    </div>

    <div class="role-overview-card">
        <div class="role-overview-icon">
            <i class="fa-solid fa-user-graduate"></i>
        </div>
        <div>
            <h4>Student</h4>
            <p>Learning materials, course activities, and student learning features.</p>
            <span class="role-label">Learning Access</span>
        </div>
    </div>
</div> <!-- End of roles-overview -->

<div class="permissions-matrix-section">
    <div class="permissions-matrix-header">
        <div>
            <h3>Permission Matrix</h3>
            <p>View the system functions available to each role.</p>
        </div>
        <span class="view-only-badge">
            <i class="fa-solid fa-eye"></i>
            View Only
        </span>
    </div>

    <div class="permissions-table-wrapper">
        <table class="permissions-table">
            <thead>
                <tr>
                    <th>System Function</th>
                    <th>Super Admin</th>
                    <th>Admin</th>
                    <th>Trainer</th>
                    <th>Student</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Account Management</td>
                    <td>Admin, Trainer, Student accounts</td>
                    <td>Users and Trainers</td>
                    <td class="permission-no">—</td>
                    <td class="permission-no">—</td>
                </tr>

                <tr>
                    <td>Registration Management</td>
                    <td class="permission-review">Review Required</td>
                    <td class="permission-yes">Allowed</td>
                    <td class="permission-no">—</td>
                    <td class="permission-no">—</td>
                </tr>

                <tr>
                    <td>Course Management</td>
                    <td class="permission-review">Review Required</td>
                    <td class="permission-yes">Allowed</td>
                    <td>Assigned course content</td>
                    <td>Browse and Enroll</td>
                </tr>

                <tr>
                    <td>Modules and Learning Materials</td>
                    <td class="permission-review">Review Required</td>
                    <td class="permission-yes">Allowed</td>
                    <td class="permission-yes">Allowed</td>
                    <td>View and Complete</td>
                </tr>

                <tr>
                    <td>Quiz Management and Assessment</td>
                    <td class="permission-review">Review Required</td>
                    <td>Manage Quizzes</td>
                    <td>Manage Quizzes</td>
                    <td>Take and Submit Quizzes</td>
                </tr>

                <tr>
                    <td>Attendance and Hands-on Evaluation</td>
                    <td class="permission-review">Review Required</td>
                    <td class="permission-review">Review Required</td>
                    <td class="permission-yes">Allowed</td>
                    <td class="permission-review">Review Required</td>
                </tr>

                <tr>
                    <td>Onsite Activities and Grades</td>
                    <td class="permission-review">Review Required</td>
                    <td class="permission-review">Review Required</td>
                    <td class="permission-yes">Allowed</td>
                    <td class="permission-review">Review Required</td>
                </tr>

                <tr>
                    <td>Announcements</td>
                    <td class="permission-review">Review Required</td>
                    <td class="permission-yes">Allowed</td>
                    <td class="permission-review">Review Required</td>
                    <td>View Announcements</td>
                </tr>

                <tr>
                    <td>Certificates</td>
                    <td class="permission-review">Review Required</td>
                    <td class="permission-yes">Allowed</td>
                    <td class="permission-yes">Allowed</td>
                    <td class="permission-review">Review Required</td>
                </tr>

                <tr>
                    <td>Landing Page Management</td>
                    <td class="permission-review">Review Required</td>
                    <td class="permission-yes">Allowed</td>
                    <td class="permission-no">—</td>
                    <td class="permission-no">—</td>
                </tr>

                <tr>
                    <td>Profile and Password Settings</td>
                    <td class="permission-review">Review Required</td>
                    <td class="permission-review">Review Required</td>
                    <td class="permission-yes">Allowed</td>
                    <td class="permission-yes">Allowed</td>
                </tr>
            </tbody>
        </table>
    </div>

    <p class="permissions-matrix-note">
        <i class="fa-solid fa-circle-info"></i>
        This matrix is informational only. It does not change system access.
        Review Required means the current route definitions do not establish
        that role's access to the function.
    </p>
</div> <!-- End of permissions-matrix-section -->

</div> <!-- End of superadmin-page-card -->

</div> <!-- End of view-roles-permissions -->



            <!-- ==================================================
             SYSTEM SETTINGS
        =================================================== -->

            <div id="view-system-settings" class="superadmin-view" style="display:none;">

                <h1 class="page-title">
                    System Settings
                </h1>

                <div class="superadmin-page-card">

                    <h3>
                        System Settings
                    </h3>

                    <p>
                        Manage system-wide settings and administrative preferences.
                    </p>


<div class="system-settings-overview">

    <!-- Application Information -->
    <div class="system-setting-card">
        <div class="system-setting-icon">
            <i class="fa-solid fa-window-maximize"></i>
        </div>

        <div class="system-setting-content">
            <h4>Application Information</h4>
            <p>View the basic information about the LEDIPO system.</p>
            <span class="system-setting-status">Information Only</span>
        </div>
    </div>

    <!-- Account Security -->
    <div class="system-setting-card">
        <div class="system-setting-icon">
            <i class="fa-solid fa-shield-halved"></i>
        </div>

        <div class="system-setting-content">
            <h4>Account Security</h4>
            <p>Review authentication, role-based access, and account security settings.</p>
            <span class="system-setting-status">Review Only</span>
        </div>
    </div>

    <!-- Email and Notifications -->
    <div class="system-setting-card">
        <div class="system-setting-icon">
            <i class="fa-solid fa-envelope"></i>
        </div>

        <div class="system-setting-content">
            <h4>Email &amp; Notifications</h4>
            <p>Review email verification and notification-related configuration.</p>
            <span class="system-setting-status">Review Only</span>
        </div>
    </div>

    <!-- Database -->
    <div class="system-setting-card">
        <div class="system-setting-icon">
            <i class="fa-solid fa-database"></i>
        </div>

        <div class="system-setting-content">
            <h4>Database Information</h4>
            <p>Identify database configuration and maintenance considerations.</p>
            <span class="system-setting-status">Information Only</span>
        </div>
    </div>

    <!-- System Maintenance -->
    <div class="system-setting-card">
        <div class="system-setting-icon">
            <i class="fa-solid fa-screwdriver-wrench"></i>
        </div>

        <div class="system-setting-content">
            <h4>System Maintenance</h4>
            <p>Reserve this section for future maintenance and backup management features.</p>
            <span class="system-setting-status">Coming Later</span>
        </div>
    </div>

    <!-- Configuration Management -->
    <div class="system-setting-card">
        <div class="system-setting-icon">
            <i class="fa-solid fa-sliders"></i>
        </div>

        <div class="system-setting-content">
            <h4>Configuration Management</h4>
            <p>Review system-wide configuration options before enabling changes.</p>
            <span class="system-setting-status">Coming Later</span>
        </div>
    </div>

</div>

<div class="system-settings-note">
    <i class="fa-solid fa-circle-info"></i>
    <span>
        This page is currently view-only. These cards are informational
        placeholders and do not read or modify actual system configuration.
    </span>
</div>


                </div>

            </div>



            <!-- ==================================================
             SYSTEM CONFIGURATION
        =================================================== -->

            <div id="view-system-configuration" class="superadmin-view" style="display:none;">

                <h1 class="page-title">
                    System Configuration
                </h1>

                <div class="superadmin-page-card">

                    <h3>
                        System Configuration
                    </h3>

                    <p>
                        Configure system-level options and application behavior.
                    </p>


<div class="system-configuration-overview">

    <!-- Application Environment -->
    <div class="system-configuration-card">
        <div class="system-configuration-icon">
            <i class="fa-solid fa-server"></i>
        </div>

        <div class="system-configuration-content">
            <h4>Application Environment</h4>
            <p>Review the application's environment and runtime configuration.</p>
            <span class="system-configuration-status">Review Only</span>
        </div>
    </div>

    <!-- Database Connection -->
    <div class="system-configuration-card">
        <div class="system-configuration-icon">
            <i class="fa-solid fa-database"></i>
        </div>

        <div class="system-configuration-content">
            <h4>Database Connection</h4>
            <p>Review database connection settings and database driver information.</p>
            <span class="system-configuration-status">Review Only</span>
        </div>
    </div>

    <!-- Email Configuration -->
    <div class="system-configuration-card">
        <div class="system-configuration-icon">
            <i class="fa-solid fa-envelope"></i>
        </div>

        <div class="system-configuration-content">
            <h4>Email Configuration</h4>
            <p>Review mail delivery settings used for verification and system emails.</p>
            <span class="system-configuration-status">Review Only</span>
        </div>
    </div>

    <!-- Session and Authentication -->
    <div class="system-configuration-card">
        <div class="system-configuration-icon">
            <i class="fa-solid fa-user-shield"></i>
        </div>

        <div class="system-configuration-content">
            <h4>Session &amp; Authentication</h4>
            <p>Review session handling and authentication-related configuration.</p>
            <span class="system-configuration-status">Review Only</span>
        </div>
    </div>

    <!-- File Storage -->
    <div class="system-configuration-card">
        <div class="system-configuration-icon">
            <i class="fa-solid fa-folder-open"></i>
        </div>

        <div class="system-configuration-content">
            <h4>File Storage</h4>
            <p>Review storage configuration for uploaded learning materials and documents.</p>
            <span class="system-configuration-status">Review Only</span>
        </div>
    </div>

    <!-- Future Configuration -->
    <div class="system-configuration-card">
        <div class="system-configuration-icon">
            <i class="fa-solid fa-sliders"></i>
        </div>

        <div class="system-configuration-content">
            <h4>Advanced Configuration</h4>
            <p>Reserve this section for future configurable system options.</p>
            <span class="system-configuration-status">Coming Later</span>
        </div>
    </div>

</div>

<div class="system-configuration-note">
    <i class="fa-solid fa-circle-info"></i>
    <span>
        This page is currently view-only. These cards are informational
        placeholders and do not read or modify actual application configuration.
    </span>
</div>

                    </div>

                </div>




<!-- ==================================================
     USER ACTIVITY LOGS
=================================================== -->

<div id="view-user-activity" class="superadmin-view" style="display:none;">

    <h1 class="page-title">
        User Activity Logs
    </h1>

    <div class="superadmin-page-card">

        <h3>User Activity</h3>

        <p>
            Review important user actions and account activity.
        </p>

        <!-- Activity Overview -->
        <div class="activity-logs-overview">

            <!-- Account Activity -->
            <div class="activity-summary-card">
                <div class="activity-summary-icon">
                    <i class="fa-solid fa-users"></i>
                </div>

                <div>
                    <h4>Account Activity</h4>
                    <p>
                        Review account-related actions and user activity records.
                    </p>
                    <span class="activity-status">View Only</span>
                </div>
            </div>

            <!-- Authentication Activity -->
            <div class="activity-summary-card">
                <div class="activity-summary-icon">
                    <i class="fa-solid fa-right-to-bracket"></i>
                </div>

                <div>
                    <h4>Authentication Activity</h4>
                    <p>
                        Reserve this section for login and logout activity records.
                    </p>
                    <span class="activity-status">Future Integration</span>
                </div>
            </div>

        </div>

        <!-- Recent Activity Table -->
        <div class="activity-log-table-section">

            <div class="activity-log-header">
                <div>
                    <h3>Recent Activity</h3>
                    <p>
                        Activity records will appear here when logging is implemented.
                    </p>
                </div>

                <span class="activity-status">
                    <i class="fa-solid fa-eye"></i>
                    View Only
                </span>
            </div>

            <div class="activity-log-table-wrapper">

                <table class="activity-log-table">

                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Activity</th>
                            <th>Details</th>
                            <th>Date &amp; Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td colspan="5" class="activity-empty-state">
                                <i class="fa-solid fa-clipboard-list"></i>

                                <strong>No activity records available</strong>

                                <span>
                                    Actual user activity has not been connected yet.
                                </span>
                            </td>
                        </tr>
                    </tbody>

                </table>

            </div>

        </div>

        <!-- Information Note -->
        <div class="activity-logs-note">
            <i class="fa-solid fa-circle-info"></i>

            <span>
                This page currently displays a sample layout only.
                It does not retrieve or record actual user activity.
                Activity tracking must be implemented separately.
            </span>
        </div>

    </div>

</div>



            <!-- ==================================================
             SYSTEM LOGS
        =================================================== -->

            <div id="view-system-logs" class="superadmin-view" style="display:none;">

                <h1 class="page-title">
                    System Logs
                </h1>

                <div class="superadmin-page-card">

                    <h3>
                        System Logs
                    </h3>

                    <p>
                        Review system-level events and administrative changes.
                    </p>

                    <div class="superadmin-placeholder">

                        <i class="fa-solid fa-file-lines"></i>

                        <strong>
                            System Logs
                        </strong>

                        <span>
                            System log records will be added here.
                        </span>

                    </div>

                </div>

            </div>



            <!-- ==================================================
             PROFILE
        =================================================== -->

            <div id="view-profile" class="superadmin-view" style="display:none;">

                <h1 class="page-title">
                    My Profile
                </h1>

                <div class="superadmin-page-card">

                    <h3>
                        SuperAdmin Profile
                    </h3>

                    <p>
                        View your current SuperAdmin account information.
                    </p>

                    <div style="
                        margin-top:18px;
                        display:grid;
                        grid-template-columns:
                            repeat(auto-fit,minmax(200px,1fr));
                        gap:12px;
                    ">

                        <div style="
                            border:1px solid #e5e5e5;
                            border-radius:8px;
                            padding:14px;
                        ">

                            <small style="
                                display:block;
                                color:#888;
                                font-size:11px;
                                margin-bottom:4px;
                            ">

                                Name

                            </small>

                            <strong style="
                                color:#333;
                                font-size:13px;
                            ">

                                {{ $superAdminName }}

                            </strong>

                        </div>


                        <div style="
                            border:1px solid #e5e5e5;
                            border-radius:8px;
                            padding:14px;
                        ">

                            <small style="
                                display:block;
                                color:#888;
                                font-size:11px;
                                margin-bottom:4px;
                            ">

                                Email

                            </small>

                            <strong style="
                                color:#333;
                                font-size:13px;
                            ">

                                {{ $superAdminUser->email }}

                            </strong>

                        </div>


                        <div style="
                            border:1px solid #e5e5e5;
                            border-radius:8px;
                            padding:14px;
                        ">

                            <small style="
                                display:block;
                                color:#888;
                                font-size:11px;
                                margin-bottom:4px;
                            ">

                                Role

                            </small>

                            <strong style="
                                color:#025628;
                                font-size:13px;
                            ">

                                SuperAdmin

                            </strong>

                        </div>

                    </div>

                </div>

            </div>


<!-- STUDENT DETAILS MODAL -->
<div id="studentDetailsModal"
     class="superadmin-modal"
     style="display:none;">

    <div class="superadmin-modal-content"
         style="max-width:600px; width:90%;">

        <div class="superadmin-modal-header">
            <h3>
                <i class="fa-solid fa-user-graduate"></i>
                Student Details
            </h3>

            <button type="button"
                    onclick="closeStudentDetails()"
                    aria-label="Close">
                &times;
            </button>
        </div>

        <div style="padding:24px;">

            <div style="
                display:grid;
                grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
                gap:16px;
            ">

                <div>
                    <small style="color:#777;">Student ID</small>
                    <p id="detailStudentId">—</p>
                </div>

                <div>
                    <small style="color:#777;">Full Name</small>
                    <p id="detailStudentName">—</p>
                </div>

                <div>
                    <small style="color:#777;">Email Address</small>
                    <p id="detailStudentEmail">—</p>
                </div>

                <div>
                    <small style="color:#777;">Username</small>
                    <p id="detailStudentUsername">—</p>
                </div>

                <div>
                    <small style="color:#777;">Contact Number</small>
                    <p id="detailStudentContact">—</p>
                </div>

                <div>
                    <small style="color:#777;">Account Status</small>
                    <p id="detailStudentStatus">—</p>
                </div>

                <div>
                    <small style="color:#777;">Role</small>
                    <p id="detailStudentRole">—</p>
                </div>

                <div>
                    <small style="color:#777;">Date Created</small>
                    <p id="detailStudentCreated">—</p>
                </div>

            </div>

        </div>

        <div style="
            display:flex;
            justify-content:flex-end;
            padding:16px 24px;
            border-top:1px solid #eee;
        ">
            <button type="button"
                    onclick="closeStudentDetails()"
                    style="
                        padding:10px 18px;
                        background:#025628;
                        color:white;
                        border:none;
                        border-radius:6px;
                        cursor:pointer;
                    ">
                Close
            </button>
        </div>

    </div>
</div>


        </main>

    </div>



    <!-- ==========================================================
     JAVASCRIPT
========================================================== -->

    <script>

        /* ==========================================================
           ADMINISTRATOR MODAL
        ========================================================== */

        function togglePasswordVisibility(inputId, iconId) {

            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {

                input.type = 'text';

                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');

            } else {

                input.type = 'password';

                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');

            }
        }

function openAddTrainerModal() {
    document.getElementById('addTrainerModal').classList.add('open');
}

function closeAddTrainerModal() {
    document.getElementById('addTrainerModal').classList.remove('open');
}

function openAddAdminModal() {
    const modal = document.getElementById('addAdminModal');

    if (modal) {
        modal.classList.add('open');
    }
}

function closeAddAdminModal() {
    const modal = document.getElementById('addAdminModal');

    if (modal) {
        modal.classList.remove('open');
    }
}




        function openEditAdminModal(id, firstname, lastname, email, username) {

            // Set the form action to the selected administrator's ID.
            document.getElementById('editAdminForm').action =
                `/superadmin/admin-accounts/${id}`;

            // Populate the administrator's current details.
            document.getElementById('edit_admin_firstname').value = firstname;
            document.getElementById('edit_admin_lastname').value = lastname;
            document.getElementById('edit_admin_email').value = email;
            document.getElementById('edit_admin_username').value = username;

            // Always start with empty password fields.
            document.getElementById('edit_admin_password').value = '';
            document.getElementById('edit_admin_password_confirmation').value = '';

            // Display the modal.
            document.getElementById('editAdminModal').classList.add('open');
        }


        function closeEditAdminModal() {

            document
                .getElementById('editAdminModal')
                .classList.remove('open');

        }



        /* ==========================================================
           PROFILE DROPDOWN
        ========================================================== */

        const avatarBtn =
            document.getElementById('avatarBtn');

        const dropdown =
            document.getElementById('dropdown');

        const notificationBtn =
            document.getElementById('notificationBtn');

        const notificationDropdown =
            document.getElementById('notificationDropdown');


        avatarBtn.addEventListener('click', function (event) {

            event.stopPropagation();

            dropdown.classList.toggle('open');

            notificationDropdown.classList.remove('open');

        });


        notificationBtn.addEventListener('click', function (event) {

            event.stopPropagation();

            notificationDropdown.classList.toggle('open');

            dropdown.classList.remove('open');

        });


        document.addEventListener('click', function (event) {

            if (!event.target.closest('.topbar-right')) {

                dropdown.classList.remove('open');

                notificationDropdown.classList.remove('open');

            }

        });



        /* ==========================================================
           LOGOUT
        ========================================================== */

        function openLogoutModal() {

            dropdown.classList.remove('open');

            document.getElementById('logoutModal').style.display = 'flex';

        }


        function closeLogoutModal() {

            document.getElementById('logoutModal').style.display = 'none';

        }


        function confirmLogout() {

            document
                .getElementById('logout-form')
                .submit();

        }


        document
            .getElementById('logoutModal')
            .addEventListener('click', function (event) {

                if (event.target === this) {

                    closeLogoutModal();

                }

            });



        /* ==========================================================
           SIDEBAR
        ========================================================== */

        const hamburger =
            document.getElementById('hamburger');

        const sidebar =
            document.getElementById('sidebar');

        const overlay =
            document.getElementById('overlay');


        hamburger.addEventListener('click', function () {

            sidebar.classList.toggle('sidebar-open');

            overlay.classList.toggle('show');

        });


        overlay.addEventListener('click', function () {

            sidebar.classList.remove('sidebar-open');

            overlay.classList.remove('show');

        });



        /* ==========================================================
           VIEW NAVIGATION
        ========================================================== */

        const viewTitles = {

            'dashboard':
                'SuperAdmin Dashboard',

            'admin-accounts':
                'Admin Accounts',

            'trainer-accounts':
                'Trainer Accounts',

            'student-accounts':
                'Student Accounts',

            'roles-permissions':
                'Roles & Permissions',

            'system-settings':
                'System Settings',

            'system-configuration':
                'System Configuration',

            'user-activity':
                'User Activity Logs',

            'system-logs':
                'System Logs',

            'profile':
                'My Profile'

        };


        function showView(view) {

            /* Hide all views */

            document
                .querySelectorAll('.superadmin-view')
                .forEach(function (element) {

                    element.style.display = 'none';

                });


            /* Show selected view */

            const selectedView =
                document.getElementById(
                    'view-' + view
                );

            if (selectedView) {

                selectedView.style.display = 'block';

            }


            /* Update page title */

            const title =
                viewTitles[view] ||
                'SuperAdmin Dashboard';

            document
                .getElementById('main-title');

            const dashboardTitle =
                document.querySelector(
                    '#view-' + view + ' .page-title'
                );

            if (dashboardTitle) {

                dashboardTitle.textContent = title;

            }


            /* Update breadcrumb */

            const breadcrumb =
                document.getElementById(
                    'breadcrumb-current'
                );

            if (breadcrumb) {

                breadcrumb.textContent = title;

            }


            /* Update active sidebar item */

            document
                .querySelectorAll(
                    '.sidebar .nav-item'
                )
                .forEach(function (item) {

                    item.classList.remove('active');

                });


            const activeItem =
                document.querySelector(
                    '.sidebar .nav-item[data-view="' +
                    view +
                    '"]'
                );

            if (activeItem) {

                activeItem.classList.add('active');

            }


            /* Close mobile sidebar */

            if (window.innerWidth <= 768) {

                sidebar.classList.remove('sidebar-open');

                overlay.classList.remove('show');

            }

        }



        /* ==========================================================
           NOTIFICATION READ STATE
        ========================================================== */

        function markNotificationRead(item) {

            if (!item) return;

            if (item.dataset.read === '1') return;

            const announcementId =
                item.dataset.announcementId;

            if (!announcementId) return;


            fetch(
                `{{ url('/notifications/announcements') }}/${announcementId}/read`,
                {
                    method: 'POST',

                    headers: {

                        'X-CSRF-TOKEN':
                            document
                                .querySelector(
                                    'meta[name="csrf-token"]'
                                )
                                .getAttribute('content'),

                        'Accept':
                            'application/json',

                        'Content-Type':
                            'application/json'

                    },

                    body: JSON.stringify({})

                }
            )
                .then(function (response) {

                    if (!response.ok) {

                        throw new Error(
                            'Unable to mark notification as read.'
                        );

                    }

                    return response.json();

                })
                .then(function (data) {

                    if (!data || !data.success) return;

                    item.dataset.read = '1';

                    item.classList.remove(
                        'notification-unread'
                    );


                    const badge =
                        document.querySelector(
                            '.notification-badge'
                        );

                    if (badge) {

                        const currentCount =
                            parseInt(
                                badge.textContent
                                    .replace('+', '')
                                    .trim(),
                                10
                            ) || 0;

                        const nextCount =
                            Math.max(
                                currentCount - 1,
                                0
                            );

                        if (nextCount === 0) {

                            badge.remove();

                        } else {

                            badge.textContent =
                                nextCount > 99
                                    ? '99+'
                                    : String(nextCount);

                        }

                    }

                })
                .catch(function (error) {

                    console.error(
                        'Notification read error:',
                        error
                    );

                });

        }


        document
            .querySelectorAll(
                '.notification-item[data-announcement-id]'
            )
            .forEach(function (item) {

                item.addEventListener(
                    'click',
                    function () {

                        markNotificationRead(this);

                    }
                );


                item.addEventListener(
                    'keydown',
                    function (event) {

                        if (
                            event.key === 'Enter' ||
                            event.key === ' '
                        ) {

                            event.preventDefault();

                            markNotificationRead(this);

                        }

                    }
                );

            });



        /* ==========================================================
           INITIAL VIEW
        ========================================================== */

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                showView('dashboard');

            }
        );


        /* ==========================================================
           STUDENT ACCOUNTS: SEARCH AND FILTER
        ========================================================== */

        const studentSearchInput =
            document.getElementById('studentSearchInput');

        const studentStatusFilter =
            document.getElementById('studentStatusFilter');

        const studentTableBody =
            document.querySelector('#view-student-accounts tbody');

        if (
            studentSearchInput &&
            studentStatusFilter &&
            studentTableBody
        ) {
            const studentRows = Array.from(
                studentTableBody.querySelectorAll('tr')
            ).filter(function (row) {
                return !row.querySelector('.empty-admins');
            });

            const noResultsRow = document.createElement('tr');

            noResultsRow.innerHTML = `
                <td colspan="5" class="empty-admins">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <strong>No matching students found.</strong>
                    <span>Try another search term or status.</span>
                </td>
            `;

            noResultsRow.style.display = 'none';
            studentTableBody.appendChild(noResultsRow);

            function filterStudentAccounts() {
                const searchTerm =
                    studentSearchInput.value.trim().toLowerCase();

                const selectedStatus =
                    studentStatusFilter.value.toLowerCase();

                let visibleCount = 0;

                studentRows.forEach(function (row) {
                    const studentName =
                        row.cells[0]?.textContent.toLowerCase() || '';

                    const studentEmail =
                        row.cells[1]?.textContent.toLowerCase() || '';

                    const studentUsername =
                        row.cells[2]?.textContent.toLowerCase() || '';

                    const studentStatus =
                        row.cells[3]
                            ?.querySelector('.status-badge')
                            ?.textContent.trim().toLowerCase() || '';

                    const matchesSearch =
                        studentName.includes(searchTerm) ||
                        studentEmail.includes(searchTerm) ||
                        studentUsername.includes(searchTerm);

                    const matchesStatus =
                        selectedStatus === '' ||
                        studentStatus === selectedStatus;

                    const shouldShow =
                        matchesSearch && matchesStatus;

                    row.style.display = shouldShow ? '' : 'none';

                    if (shouldShow) {
                        visibleCount++;
                    }
                });

                noResultsRow.style.display =
                    studentRows.length > 0 && visibleCount === 0
                        ? ''
                        : 'none';
            }

            studentSearchInput.addEventListener(
                'input',
                filterStudentAccounts
            );

            studentStatusFilter.addEventListener(
                'change',
                filterStudentAccounts
            );
        }


/* ==========================================================
   STUDENT ACCOUNTS: VIEW STUDENT DETAILS
========================================================== */

function viewStudentDetails(
    id,
    firstname,
    lastname,
    email,
    username,
    status,
    createdAt,
    contact,
    role
) {
    document.getElementById('detailStudentId').textContent = id;
    document.getElementById('detailStudentName').textContent =
        `${firstname} ${lastname}`;

    document.getElementById('detailStudentEmail').textContent = email;
    document.getElementById('detailStudentUsername').textContent = username;
    document.getElementById('detailStudentContact').textContent = contact;
    document.getElementById('detailStudentStatus').textContent = status;
    document.getElementById('detailStudentRole').textContent = role;
    document.getElementById('detailStudentCreated').textContent = createdAt;

    const modal = document.getElementById('studentDetailsModal');

    modal.style.display = 'flex';
}

function closeStudentDetails() {
    const modal = document.getElementById('studentDetailsModal');

    modal.style.display = 'none';
}

/* Close the modal when clicking outside its content */
document.addEventListener('click', function (event) {
    const modal = document.getElementById('studentDetailsModal');

    if (modal && event.target === modal) {
        closeStudentDetails();
    }
});

/* Close the modal using the Escape key */
document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
        closeStudentDetails();
    }
});


    
    </script>


</body>

</html>