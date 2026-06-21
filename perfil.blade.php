Aqui está a página de detalhes do agricultor seguindo o layout da página de Configurações (com sidebar lateral esquerda e conteúdo à direita), com dados estáticos para visualização:

```blade
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SIAG – João Manuel Ferreira</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap"
    rel="stylesheet" />

  <style>
    :root {
      --sidebar-bg: #1B5E20;
      --sidebar-hover: #2E7D32;
      --sidebar-active: #2E7D32;
      --accent: #66BB6A;
      --accent-lt: #E8F5E9;
      --primary: #2E7D32;
      --text-dark: #1C2B1E;
      --text-mid: #4A6350;
      --text-light: #8FA894;
      --border: rgba(0, 0, 0, .07);
      --card-bg: #ffffff;
      --page-bg: #F4F6F4;
      --sidebar-w: 240px;
      --sidebar-w-icons: 68px;
      --topbar-h: 64px;
      --danger: #C62828;
      --warning: #F57F17;
      --info: #1565C0;
    }

    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--page-bg);
      color: var(--text-dark);
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* ═══════════════════════════════════════════
       SIDEBAR
    ═══════════════════════════════════════════ */
    #sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: var(--sidebar-w);
      height: 100vh;
      background: var(--sidebar-bg);
      display: flex;
      flex-direction: column;
      transition: width .3s ease;
      z-index: 1000;
      overflow: hidden;
    }

    body.icons-only #sidebar {
      width: var(--sidebar-w-icons);
    }

    body.sidebar-hidden #sidebar {
      width: 0;
    }

    .sidebar-logo {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 14px 15px;
      border-bottom: 1px solid rgba(255, 255, 255, .1);
      white-space: nowrap;
      min-height: var(--topbar-h);
      overflow: hidden;
    }

    body.icons-only .sidebar-logo {
      justify-content: center;
      padding: 14px 0;
    }

    body.icons-only .sidebar-logo .logo-text-wrap {
      opacity: 0;
      pointer-events: none;
      width: 0;
      overflow: hidden;
    }

    .sidebar-nav {
      flex: 1;
      padding: 12px 0;
      overflow-y: auto;
      overflow-x: hidden;
    }

    .sidebar-nav::-webkit-scrollbar {
      width: 4px;
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, .18);
      border-radius: 10px;
    }

    .sidebar-nav {
      scrollbar-width: thin;
      scrollbar-color: rgba(255, 255, 255, .18) transparent;
    }

    .nav-section-title {
      font-size: 10px;
      font-weight: 600;
      letter-spacing: 1.2px;
      text-transform: uppercase;
      color: rgba(255, 255, 255, .4);
      padding: 18px 20px 6px;
      white-space: nowrap;
      transition: opacity .2s;
    }

    body.icons-only .nav-section-title {
      opacity: 0;
      height: 0;
      padding: 0;
      overflow: hidden;
    }

    .nav-item-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 11px 18px;
      color: rgba(255, 255, 255, .75);
      text-decoration: none;
      border-radius: 10px;
      margin: 2px 8px;
      transition: background .2s, color .15s;
      white-space: nowrap;
      position: relative;
    }

    .nav-item-link i {
      font-size: 18px;
      flex-shrink: 0;
      width: 22px;
      text-align: center;
    }

    .nav-item-link .nav-label {
      font-size: 14px;
      font-weight: 500;
      opacity: 1;
      transition: opacity .2s;
    }

    body.icons-only .nav-item-link .nav-label {
      opacity: 0;
      pointer-events: none;
      width: 0;
      overflow: hidden;
    }

    body.icons-only .nav-item-link {
      justify-content: center;
      padding: 11px 0;
      margin: 2px 6px;
    }

    .nav-item-link:hover {
      background: rgba(255, 255, 255, .1);
      color: #fff;
    }

    .nav-item-link.active {
      background: var(--accent);
      color: #fff;
      box-shadow: 0 4px 14px rgba(102, 187, 106, .35);
    }

    .sidebar-tooltip .tooltip-inner {
      background: #0f3d14;
      color: #fff;
      font-size: 12.5px;
      font-weight: 500;
      padding: 5px 12px;
      border-radius: 8px;
      box-shadow: 0 4px 14px rgba(0, 0, 0, .3);
    }

    .sidebar-tooltip.bs-tooltip-end .tooltip-arrow::before {
      border-right-color: #0f3d14;
    }

    .sidebar-user {
      padding: 14px 10px;
      border-top: 1px solid rgba(255, 255, 255, .1);
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      transition: background .2s;
      border-radius: 10px;
      margin: 4px 6px;
      white-space: nowrap;
    }

    .sidebar-user:hover {
      background: rgba(255, 255, 255, .08);
    }

    .sidebar-user .avatar {
      width: 34px;
      height: 34px;
      background: var(--accent);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      overflow: hidden;
    }

    .sidebar-user .avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .sidebar-user .avatar i {
      color: #fff;
      font-size: 16px;
    }

    .sidebar-user .user-info {
      opacity: 1;
      transition: opacity .2s;
    }

    .sidebar-user .user-info .u-name {
      font-size: 13px;
      font-weight: 600;
      color: #fff;
    }

    .sidebar-user .user-info .u-role {
      font-size: 11px;
      color: rgba(255, 255, 255, .5);
    }

    body.icons-only .sidebar-user .user-info {
      opacity: 0;
      pointer-events: none;
    }

    /* ═══════════════════════════════════════════
       TOPBAR
    ═══════════════════════════════════════════ */
    #topbar {
      position: fixed;
      top: 0;
      left: var(--sidebar-w);
      right: 0;
      height: var(--topbar-h);
      background: #fff;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      padding: 0 28px;
      gap: 16px;
      z-index: 900;
      transition: left .3s ease;
    }

    body.icons-only #topbar {
      left: var(--sidebar-w-icons);
    }

    body.sidebar-hidden #topbar {
      left: 0;
    }

    .topbar-toggle {
      background: none;
      border: none;
      font-size: 20px;
      color: var(--text-mid);
      cursor: pointer;
      padding: 6px;
      border-radius: 8px;
      transition: background .2s, color .2s;
    }

    .topbar-toggle:hover {
      background: var(--accent-lt);
      color: var(--primary);
    }

    .topbar-title-wrap {
      display: flex;
      flex-direction: column;
      line-height: 1.2;
    }

    .topbar-title {
      font-family: 'Sora', sans-serif;
      font-size: 16px;
      font-weight: 600;
      color: var(--text-dark);
    }

    .topbar-subtitle {
      font-size: 12px;
      color: var(--text-light);
    }

    .topbar-right {
      margin-left: auto;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .topbar-icon-btn {
      width: 38px;
      height: 38px;
      border: none;
      background: var(--accent-lt);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary);
      font-size: 17px;
      cursor: pointer;
      transition: background .2s, color .2s;
      position: relative;
    }

    .topbar-icon-btn:hover {
      background: var(--primary);
      color: #fff;
    }

    .notif-badge {
      position: absolute;
      top: 6px;
      right: 6px;
      width: 8px;
      height: 8px;
      background: #E53935;
      border-radius: 50%;
      border: 2px solid #fff;
    }

    .topbar-user {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 6px 12px;
      background: var(--accent-lt);
      border-radius: 30px;
      cursor: pointer;
      transition: background .2s;
    }

    .topbar-user:hover {
      background: #C8E6C9;
    }

    .topbar-user .t-avatar {
      width: 30px;
      height: 30px;
      background: var(--primary);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .topbar-user .t-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .avatar-md {
      width: 30px !important;
      height: 30px;
      object-fit: cover;
      border-radius: 50%;
    }

    .topbar-user .t-avatar i {
      color: #fff;
      font-size: 14px;
    }

    .topbar-user span {
      font-size: 13px;
      font-weight: 500;
      color: var(--primary);
    }

    /* Dropdown topbar */
    .dropdown-menu-user {
      min-width: 200px;
      border: 1px solid var(--border);
      border-radius: 14px;
      box-shadow: 0 12px 36px rgba(0, 0, 0, .12);
      padding: 6px;
      margin-top: 8px !important;
    }

    .dropdown-menu-user .dropdown-header {
      font-size: 11px;
      font-weight: 600;
      letter-spacing: .8px;
      text-transform: uppercase;
      color: var(--text-light);
      padding: 6px 12px 4px;
    }

    .dropdown-menu-user .dropdown-item {
      font-size: 13.5px;
      color: var(--text-mid);
      border-radius: 8px;
      padding: 9px 12px;
      display: flex;
      align-items: center;
      gap: 9px;
      transition: background .15s, color .15s;
    }

    .dropdown-menu-user .dropdown-item i {
      font-size: 15px;
      color: var(--text-light);
    }

    .dropdown-menu-user .dropdown-item:hover {
      background: var(--accent-lt);
      color: var(--primary);
    }

    .dropdown-menu-user .dropdown-item:hover i {
      color: var(--primary);
    }

    .dropdown-menu-user .dropdown-divider {
      margin: 4px 6px;
      border-color: var(--border);
    }

    .dropdown-menu-user .item-logout {
      color: #C62828;
    }

    .dropdown-menu-user .item-logout i {
      color: #C62828;
    }

    .dropdown-menu-user .item-logout:hover {
      background: #FFEBEE;
      color: #C62828;
    }

    .dropdown-menu-user form {
      margin: 0;
    }

    .dropdown-menu-user form button {
      background: none;
      border: none;
      font-size: 13.5px;
      color: #C62828;
      border-radius: 8px;
      padding: 9px 12px;
      width: 100%;
      text-align: left;
      display: flex;
      align-items: center;
      gap: 9px;
      cursor: pointer;
      transition: background .15s;
    }

    .dropdown-menu-user form button:hover {
      background: #FFEBEE;
    }

    .dropdown-menu-user form button i {
      font-size: 15px;
      color: #C62828;
    }

    /* ═══════════════════════════════════════════
       MAIN CONTENT
    ═══════════════════════════════════════════ */
    #main {
      margin-left: var(--sidebar-w);
      padding-top: var(--topbar-h);
      transition: margin-left .3s ease;
      min-height: 100vh;
    }

    body.icons-only #main {
      margin-left: var(--sidebar-w-icons);
    }

    body.sidebar-hidden #main {
      margin-left: 0;
    }

    .content-inner {
      padding: 28px;
    }

    /* ═══════════════════════════════════════════
       PAGE HEADER
    ═══════════════════════════════════════════ */
    .page-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: 28px;
      flex-wrap: wrap;
      gap: 12px;
    }

    .page-header h1 {
      font-family: 'Sora', sans-serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--text-dark);
      margin-bottom: 3px;
    }

    .page-header p {
      font-size: 13.5px;
      color: var(--text-light);
    }

    .btn-green {
      background: var(--primary);
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 9px 18px;
      font-size: 13.5px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
      transition: background .2s, transform .1s;
      text-decoration: none;
    }

    .btn-green:hover {
      background: var(--accent);
      color: #fff;
    }

    .btn-green:active {
      transform: scale(.97);
    }

    .btn-outline-green {
      background: transparent;
      color: var(--primary);
      border: 1.5px solid var(--primary);
      border-radius: 10px;
      padding: 8px 16px;
      font-size: 13.5px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
      transition: background .2s, color .2s;
      text-decoration: none;
    }

    .btn-outline-green:hover {
      background: var(--accent-lt);
      color: var(--primary);
    }

    /* ═══════════════════════════════════════════
       SETTINGS LAYOUT — lateral tabs + content
    ═══════════════════════════════════════════ */
    .settings-wrap {
      display: flex;
      gap: 24px;
      align-items: flex-start;
    }

    /* ── VERTICAL TABS NAV ─── */
    .settings-nav {
      flex-shrink: 0;
      width: 220px;
      background: var(--card-bg);
      border-radius: 16px;
      border: 1px solid var(--border);
      padding: 10px;
      position: sticky;
      top: calc(var(--topbar-h) + 28px);
    }

    .settings-nav-item {
      display: flex;
      align-items: center;
      gap: 11px;
      padding: 11px 14px;
      border-radius: 10px;
      cursor: pointer;
      color: var(--text-mid);
      font-size: 13.5px;
      font-weight: 500;
      transition: background .15s, color .15s;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      white-space: nowrap;
    }

    .settings-nav-item i {
      font-size: 16px;
      color: var(--text-light);
      transition: color .15s;
    }

    .settings-nav-item:hover {
      background: var(--accent-lt);
      color: var(--primary);
    }

    .settings-nav-item:hover i {
      color: var(--primary);
    }

    .settings-nav-item.active {
      background: var(--accent-lt);
      color: var(--primary);
      font-weight: 600;
    }

    .settings-nav-item.active i {
      color: var(--primary);
    }

    .settings-nav-divider {
      height: 1px;
      background: var(--border);
      margin: 8px 0;
    }

    /* ── CONTENT PANELS ─── */
    .settings-content {
      flex: 1;
      min-width: 0;
    }

    .settings-panel {
      display: none;
    }

    .settings-panel.active {
      display: block;
    }

    /* ── CARDS GERAIS ─── */
    .cfg-card {
      background: var(--card-bg);
      border-radius: 16px;
      border: 1px solid var(--border);
      margin-bottom: 20px;
      overflow: hidden;
    }

    .cfg-card-header {
      padding: 18px 24px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
    }

    .cfg-card-header-left {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .cfg-card-icon {
      width: 40px;
      height: 40px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
    }

    .cfg-card-icon.green {
      background: var(--accent-lt);
      color: var(--primary);
    }

    .cfg-card-icon.blue {
      background: #E3F2FD;
      color: #1565C0;
    }

    .cfg-card-icon.amber {
      background: #FFF8E1;
      color: #F57F17;
    }

    .cfg-card-icon.red {
      background: #FFEBEE;
      color: #C62828;
    }

    .cfg-card-icon.purple {
      background: #EDE7F6;
      color: #6A1B9A;
    }

    .cfg-card-icon.teal {
      background: #E0F2F1;
      color: #00695C;
    }

    .cfg-card-title {
      font-family: 'Sora', sans-serif;
      font-size: 14.5px;
      font-weight: 600;
      color: var(--text-dark);
    }

    .cfg-card-sub {
      font-size: 12px;
      color: var(--text-light);
      margin-top: 2px;
    }

    .cfg-card-body {
      padding: 22px 24px;
    }

    /* ── Tabelas ─── */
    .tab-table-wrap {
      overflow-x: auto;
    }

    .tab-table {
      width: 100%;
      border-collapse: collapse;
    }

    .tab-table th {
      font-size: 11px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: .8px;
      color: var(--text-light);
      padding: 10px 14px;
      background: #FAFBFA;
      border-bottom: 1px solid var(--border);
      text-align: left;
      white-space: nowrap;
    }

    .tab-table td {
      font-size: 13px;
      color: var(--text-dark);
      padding: 12px 14px;
      border-bottom: 1px solid var(--border);
      vertical-align: middle;
    }

    .tab-table tr:last-child td {
      border-bottom: none;
    }

    .tab-table tbody tr:hover td {
      background: #F8FBF8;
    }

    .tab-empty {
      text-align: center;
      padding: 40px 20px;
      color: var(--text-light);
    }

    .tab-empty i {
      font-size: 40px;
      opacity: .3;
      display: block;
      margin-bottom: 12px;
    }

    .tab-total {
      text-align: right;
      padding: 12px 0 0;
      border-top: 1px solid var(--border);
      margin-top: 12px;
    }

    .tab-total strong {
      color: var(--primary);
      font-size: 15px;
    }

    /* ── BADGE STATUS ─── */
    .badge-status {
      font-size: 12px;
      font-weight: 600;
      padding: 5px 16px;
      border-radius: 30px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .badge-status.activo {
      background: #E8F5E9;
      color: #2E7D32;
    }

    .badge-status.inactivo {
      background: #FFEBEE;
      color: #C62828;
    }

    .badge-status.pendente {
      background: #FFF8E1;
      color: #F57F17;
    }

    .badge-status .dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      display: inline-block;
    }

    .badge-status.activo .dot {
      background: #2E7D32;
    }

    .badge-status.inactivo .dot {
      background: #C62828;
    }

    .badge-status.pendente .dot {
      background: #F57F17;
    }

    /* ── PERFIL SIDEBAR ─── */
    .perfil-avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      overflow: hidden;
      margin: 0 auto 16px;
      border: 3px solid var(--accent);
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--accent-lt);
    }

    .perfil-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .perfil-avatar .no-photo {
      font-size: 36px;
      color: var(--primary);
      font-weight: 700;
    }

    .perfil-nome {
      font-family: 'Sora', sans-serif;
      font-size: 16px;
      font-weight: 700;
      text-align: center;
      color: var(--text-dark);
    }

    .perfil-cooperativa {
      text-align: center;
      font-size: 12.5px;
      color: var(--text-light);
    }

    .perfil-cargo {
      text-align: center;
      font-size: 12px;
      color: var(--text-mid);
      background: var(--accent-lt);
      padding: 4px 14px;
      border-radius: 20px;
      display: inline-block;
      margin: 6px auto 12px;
    }

    .perfil-info-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 7px 0;
      border-bottom: 1px solid var(--border);
      font-size: 13px;
    }

    .perfil-info-item:last-child {
      border-bottom: none;
    }

    .perfil-info-item .pi-icon {
      width: 28px;
      height: 28px;
      border-radius: 8px;
      background: var(--accent-lt);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary);
      font-size: 14px;
      flex-shrink: 0;
    }

    .perfil-info-item .pi-label {
      color: var(--text-light);
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: .5px;
    }

    .perfil-info-item .pi-value {
      font-weight: 500;
      color: var(--text-dark);
    }

    .perfil-status {
      text-align: center;
      padding-top: 12px;
      margin-top: 12px;
      border-top: 1px solid var(--border);
    }

    .btn-voltar {
      display: flex;
      align-items: center;
      gap: 6px;
      color: var(--text-mid);
      text-decoration: none;
      font-size: 13px;
      padding: 4px 0;
      margin-bottom: 16px;
      transition: color .2s;
    }

    .btn-voltar:hover {
      color: var(--primary);
    }

    /* ── STATS MINI CARDS ─── */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 12px;
      margin-bottom: 20px;
    }

    .stat-mini-card {
      background: var(--card-bg);
      border-radius: 12px;
      border: 1px solid var(--border);
      padding: 14px 16px;
      display: flex;
      align-items: center;
      gap: 12px;
      transition: box-shadow .2s;
    }

    .stat-mini-card:hover {
      box-shadow: 0 4px 16px rgba(46, 125, 50, .08);
    }

    .stat-mini-card .sm-icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
    }

    .stat-mini-card .sm-icon.green {
      background: var(--accent-lt);
      color: var(--primary);
    }

    .stat-mini-card .sm-icon.blue {
      background: #E3F2FD;
      color: #1565C0;
    }

    .stat-mini-card .sm-icon.amber {
      background: #FFF8E1;
      color: #F57F17;
    }

    .stat-mini-card .sm-icon.purple {
      background: #EDE7F6;
      color: #6A1B9A;
    }

    .stat-mini-card .sm-icon.red {
      background: #FFEBEE;
      color: #C62828;
    }

    .stat-mini-card .sm-info .sm-label {
      font-size: 10px;
      color: var(--text-light);
      text-transform: uppercase;
      letter-spacing: .5px;
    }

    .stat-mini-card .sm-info .sm-value {
      font-family: 'Sora', sans-serif;
      font-size: 18px;
      font-weight: 700;
      color: var(--text-dark);
      line-height: 1.2;
    }

    .stat-mini-card .sm-info .sm-sub {
      font-size: 10px;
      color: var(--warning);
    }

    /* ── RESPONSIVE ─── */
    @media (max-width: 992px) {
      .settings-wrap {
        flex-direction: column;
      }

      .settings-nav {
        width: 100%;
        position: static;
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        padding: 8px;
      }

      .settings-nav-item {
        width: auto;
        padding: 8px 12px;
        font-size: 12.5px;
      }

      .settings-nav-divider {
        display: none;
      }

      .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
      }
    }

    @media (max-width: 768px) {
      :root {
        --sidebar-w: 240px;
      }

      body:not(.sidebar-hidden) #sidebar {
        box-shadow: 4px 0 20px rgba(0, 0, 0, .2);
      }

      body.default #sidebar {
        width: 0;
      }

      body.default #main {
        margin-left: 0;
      }

      body.default #topbar {
        left: 0;
      }

      .content-inner {
        padding: 16px;
      }
    }

    /* Dark mode */
    body.dark-mode {
      --card-bg: #1e2a20;
      --page-bg: #141d15;
      --text-dark: #e8f0e9;
      --text-mid: #9ab89e;
      --text-light: #6a8a6e;
      --border: rgba(255, 255, 255, .07);
    }

    body.dark-mode #topbar {
      background: #1e2a20;
      border-color: rgba(255, 255, 255, .06);
    }

    body.dark-mode .topbar-title {
      color: #e8f0e9;
    }

    body.dark-mode .topbar-user {
      background: rgba(102, 187, 106, .15);
    }

    body.dark-mode .topbar-user span {
      color: #66BB6A;
    }

    body.dark-mode .topbar-icon-btn {
      background: rgba(102, 187, 106, .12);
    }

    body.dark-mode .tab-table th {
      background: #172518;
    }

    body.dark-mode .tab-table tbody tr:hover td {
      background: #1a2a1c;
    }

    body.dark-mode .settings-nav {
      background: #1e2a20;
    }

    body.dark-mode .cfg-card {
      background: #1e2a20;
    }

    body.dark-mode .stat-mini-card {
      background: #1e2a20;
    }
  </style>
</head>

<body>

  <!-- ══════════════════════════════════════
     SIDEBAR
══════════════════════════════════════ -->
  <nav id="sidebar">
    <div class="sidebar-logo">
      <div class="logo-svg-wrap">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 340" width="38" height="38" style="flex-shrink:0;">
          <circle cx="170" cy="170" r="145" fill="#66BB6A" />
          <g fill="#ffffff" stroke="#ffffff" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round">
            <circle cx="118" cy="188" r="48" fill="none" stroke-width="6" />
            <circle cx="118" cy="188" r="35" fill="none" stroke-width="4.5" />
            <circle cx="118" cy="188" r="16" fill="#ffffff" />
            <path
              d="M 118 135 L 118 144 M 118 232 L 118 241 M 65 188 L 74 188 M 162 188 L 171 188 M 81 151 L 88 157 M 155 219 L 162 225 M 81 225 L 88 219 M 155 151 L 162 157"
              stroke-width="6" />
            <path d="M 68 185 C 68 140, 108 120, 160 128 C 171 132, 174 144, 174 151" fill="none" stroke-width="6" />
            <circle cx="231" cy="204" r="26" fill="none" stroke-width="5" />
            <circle cx="231" cy="204" r="10" fill="#ffffff" />
            <path
              d="M 231 174 L 231 180 M 231 228 L 231 234 M 201 204 L 207 204 M 255 204 L 261 204 M 210 183 L 214 187 M 248 221 L 252 225 M 210 225 L 214 221 M 248 183 L 252 187"
              stroke-width="4" />
            <path
              d="M 117 125 L 117 105 C 117 102, 120 99, 125 99 L 176 99 C 181 99, 184 102, 185 107 L 202 157 L 176 157"
              fill="none" stroke-width="6" />
            <path d="M 144 99 L 144 128 L 187 128" fill="none" stroke-width="4" />
            <path d="M 174 151 L 246 156 C 252 156, 254 159, 254 165 L 254 197 L 202 197 Z" fill="#ffffff" />
            <rect x="168" y="173" width="18" height="9" fill="none" stroke-width="4.5" />
            <rect x="168" y="185" width="18" height="7" fill="none" stroke-width="4.5" />
            <path d="M 223 156 L 223 125 C 223 119, 219 117, 219 113 L 220 107" fill="none" stroke-width="4.5" />
            <ellipse cx="239" cy="171" rx="6" ry="4" fill="#66BB6A" stroke="none" />
            <line x1="212" y1="170" x2="212" y2="188" stroke="#66BB6A" stroke-width="4" />
            <line x1="220" y1="170" x2="220" y2="188" stroke="#66BB6A" stroke-width="4" />
            <line x1="228" y1="170" x2="228" y2="188" stroke="#66BB6A" stroke-width="4" />
          </g>
        </svg>
      </div>
      <div class="logo-text-wrap" style="opacity:1;transition:opacity .2s;white-space:nowrap;">
        <div
          style="font-family:'Sora',sans-serif;font-size:17px;font-weight:700;color:#fff;letter-spacing:1px;line-height:1.1;">
          SIAG</div>
        <div style="font-size:10px;color:rgba(255,255,255,.5);letter-spacing:.5px;">Agrícola Cooperativas</div>
      </div>
    </div>

    <div class="sidebar-nav">
      <div class="nav-section-title">Principal</div>
      <a href="#" class="nav-item-link" data-label="Dashboard"><i class="bi bi-grid-1x2-fill"></i><span
          class="nav-label">Dashboard</span></a>
      <a href="#" class="nav-item-link" data-label="Cooperativa"><i class="bi bi-building"></i><span
          class="nav-label">Cooperativa</span></a>
      <a href="#" class="nav-item-link active" data-label="Agricultores"><i class="bi bi-person-badge-fill"></i><span
          class="nav-label">Agricultores</span></a>

      <div class="nav-section-title">Agrícola</div>
      <a href="#" class="nav-item-link" data-label="Safras"><i class="bi bi-flower2"></i><span
          class="nav-label">Safras</span></a>
      <a href="#" class="nav-item-link" data-label="Talhões"><i class="bi bi-map-fill"></i><span
          class="nav-label">Talhões</span></a>
      <a href="#" class="nav-item-link" data-label="Insumos"><i class="bi bi-box-seam-fill"></i><span
          class="nav-label">Insumos</span></a>

      <div class="nav-section-title">Financeiro</div>
      <a href="#" class="nav-item-link" data-label="Contas a Pagar"><i class="bi bi-arrow-down-circle-fill"></i><span
          class="nav-label">Contas a Pagar</span></a>
      <a href="#" class="nav-item-link" data-label="Contas a Receber"><i class="bi bi-arrow-up-circle-fill"></i><span
          class="nav-label">Contas a Receber</span></a>
      <a href="#" class="nav-item-link" data-label="Fluxo de Caixa"><i class="bi bi-cash-stack"></i><span
          class="nav-label">Fluxo de Caixa</span></a>

      <div class="nav-section-title">Comercial</div>
      <a href="#" class="nav-item-link" data-label="Vendas"><i class="bi bi-cart-fill"></i><span
          class="nav-label">Vendas</span></a>
      <a href="#" class="nav-item-link" data-label="Contratos"><i class="bi bi-file-earmark-text-fill"></i><span
          class="nav-label">Contratos</span></a>

      <div class="nav-section-title">Sistema</div>
      <a href="#" class="nav-item-link" data-label="Relatórios"><i class="bi bi-bar-chart-fill"></i><span
          class="nav-label">Relatórios</span></a>
      <a href="#" class="nav-item-link" data-label="Configurações"><i class="bi bi-gear-fill"></i><span
          class="nav-label">Configurações</span></a>
    </div>

    <div class="sidebar-user">
      <div class="avatar">
        <span style="color:#fff;font-weight:700;font-size:15px;">A</span>
      </div>
      <div class="user-info">
        <div class="u-name">Administrador</div>
        <div class="u-role">Admin · Viana</div>
      </div>
    </div>
  </nav>

  <!-- ══════════════════════════════════════
     TOPBAR
══════════════════════════════════════ -->
  <header id="topbar">
    <button class="topbar-toggle" id="sidebarToggle" title="Toggle Sidebar">
      <i class="bi bi-list"></i>
    </button>
    <div class="topbar-title-wrap">
      <span class="topbar-title">João Manuel Ferreira</span>
      <span class="topbar-subtitle">
        <i class="bi bi-building me-1"></i>Coop. Agrícola de Viana · Presidente
      </span>
    </div>
    <nav aria-label="breadcrumb" class="d-none d-md-flex ms-3">
      <ol class="breadcrumb mb-0" style="font-size:12.5px;">
        <li class="breadcrumb-item"><a href="#" style="color:var(--primary);text-decoration:none;">SIAG</a></li>
        <li class="breadcrumb-item"><a href="#" style="color:var(--primary);text-decoration:none;">Agricultores</a></li>
        <li class="breadcrumb-item active" style="color:var(--text-light);">João Manuel Ferreira</li>
      </ol>
    </nav>
    <div class="topbar-right">
      <span class="badge rounded-pill d-none d-md-inline-flex align-items-center gap-1"
        style="background:var(--accent-lt);color:var(--primary);font-size:12px;padding:7px 13px;font-weight:600;">
        <i class="bi bi-calendar3"></i> Safra 2024/25
      </span>
      <button class="topbar-icon-btn" title="Notificações">
        <i class="bi bi-bell-fill"></i><span class="notif-badge"></span>
      </button>
      <button class="topbar-icon-btn" title="Mensagens">
        <i class="bi bi-chat-dots-fill"></i>
      </button>
      <div class="dropdown d-none d-sm-flex">
        <div class="topbar-user" data-bs-toggle="dropdown" data-bs-offset="0,4" role="button">
          <div class="t-avatar">
            <span style="color:#fff;font-weight:700;font-size:14px;">A</span>
          </div>
          <span>Administrador</span>
          <i class="bi bi-chevron-down" style="font-size:11px;color:var(--primary);"></i>
        </div>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-user">
          <li><span class="dropdown-header">Nível: Administrador</span></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="#"><i class="bi bi-person-gear"></i> Minha Conta</a></li>
          <li>
            <a class="dropdown-item" href="#" id="themeToggle">
              <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
              <span id="themeLabel">Modo Escuro</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <div class="dropdown-item item-logout p-0">
              <form method="POST" action="#">
                @csrf
                <button type="submit"><i class="bi bi-box-arrow-right"></i> Sair</button>
              </form>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </header>

  <!-- ══════════════════════════════════════
     MAIN
══════════════════════════════════════ -->
  <main id="main">
    <div class="content-inner">

      <!-- Page Header -->
      <div class="page-header anim">
        <div>
          <h1>Detalhes do Agricultor</h1>
          <p>Informações completas e histórico do agricultor</p>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
          <a href="#" class="btn-outline-green">
            <i class="bi bi-pencil-fill"></i> Editar
          </a>
          <a href="#" class="btn-green">
            <i class="bi bi-arrow-left"></i> Voltar
          </a>
        </div>
      </div>

      <!-- Settings Layout -->
      <div class="settings-wrap anim anim-d1">

        <!-- ── SIDEBAR PERFIL (esquerda) ── -->
        <nav class="settings-nav">
          <a href="#" class="btn-voltar" style="padding:4px 14px;margin-bottom:8px;">
            <i class="bi bi-arrow-left"></i> Voltar
          </a>

          <div class="perfil-avatar">
            <span class="no-photo">J</span>
          </div>

          <div class="perfil-nome">João Manuel Ferreira</div>
          <div class="perfil-cooperativa">
            <i class="bi bi-building me-1"></i>Coop. Agrícola de Viana
          </div>
          <div style="text-align:center;">
            <span class="perfil-cargo"><i class="bi bi-briefcase me-1"></i>Presidente</span>
          </div>

          <div class="perfil-status">
            <span class="badge-status activo">
              <span class="dot"></span> Activo
            </span>
            <span class="badge-status" style="background:#EDE7F6;color:#6A1B9A;">
              <i class="bi bi-person-badge"></i> Direcção
            </span>
          </div>

          <hr style="margin:14px 0;border-color:var(--border);">

          <div class="perfil-info-item">
            <div class="pi-icon"><i class="bi bi-gender-ambiguous"></i></div>
            <div>
              <div class="pi-label">Sexo</div>
              <div class="pi-value">Masculino</div>
            </div>
          </div>

          <div class="perfil-info-item">
            <div class="pi-icon"><i class="bi bi-calendar-event"></i></div>
            <div>
              <div class="pi-label">Data de Nascimento</div>
              <div class="pi-value">15/03/1979 <span style="color:var(--text-light);font-size:12px;">(45 anos)</span></div>
            </div>
          </div>

          <div class="perfil-info-item">
            <div class="pi-icon"><i class="bi bi-card-id"></i></div>
            <div>
              <div class="pi-label">Bilhete de Identidade</div>
              <div class="pi-value">006234890LA042</div>
            </div>
          </div>

          <div class="perfil-info-item">
            <div class="pi-icon"><i class="bi bi-receipt"></i></div>
            <div>
              <div class="pi-label">NIF</div>
              <div class="pi-value">004512378</div>
            </div>
          </div>

          <div class="perfil-info-item">
            <div class="pi-icon"><i class="bi bi-telephone"></i></div>
            <div>
              <div class="pi-label">Telefone</div>
              <div class="pi-value">+244 912 333 444</div>
              <div style="font-size:12px;color:var(--text-light);">+244 923 456 789</div>
            </div>
          </div>

          <div class="perfil-info-item">
            <div class="pi-icon"><i class="bi bi-envelope"></i></div>
            <div>
              <div class="pi-label">E-mail</div>
              <div class="pi-value" style="font-size:12px;">joao.ferreira@email.ao</div>
            </div>
          </div>

          <div class="perfil-info-item">
            <div class="pi-icon"><i class="bi bi-geo-alt"></i></div>
            <div>
              <div class="pi-label">Endereço</div>
              <div class="pi-value" style="font-size:12px;">Bairro Kicolo, Rua 5, Viana, Luanda</div>
            </div>
          </div>

          <div class="perfil-info-item">
            <div class="pi-icon"><i class="bi bi-clock-history"></i></div>
            <div>
              <div class="pi-label">Associado desde</div>
              <div class="pi-value">22/06/2018</div>
              <div style="font-size:11px;color:var(--text-light);">há 6 anos</div>
            </div>
          </div>
        </nav>

        <!-- ── CONTENT PANELS ── -->
        <div class="settings-content">

          <!-- Stats Cards -->
          <div class="stats-grid">
            <div class="stat-mini-card">
              <div class="sm-icon green"><i class="bi bi-flower2"></i></div>
              <div class="sm-info">
                <div class="sm-label">Colheitas</div>
                <div class="sm-value">14</div>
              </div>
            </div>
            <div class="stat-mini-card">
              <div class="sm-icon blue"><i class="bi bi-box-seam"></i></div>
              <div class="sm-info">
                <div class="sm-label">Insumos</div>
                <div class="sm-value">8</div>
                <div class="sm-sub">2 em baixo</div>
              </div>
            </div>
            <div class="stat-mini-card">
              <div class="sm-icon amber"><i class="bi bi-cube"></i></div>
              <div class="sm-info">
                <div class="sm-label">Produtos</div>
                <div class="sm-value">6</div>
                <div class="sm-sub">1 em baixo</div>
              </div>
            </div>
            <div class="stat-mini-card">
              <div class="sm-icon purple"><i class="bi bi-map"></i></div>
              <div class="sm-info">
                <div class="sm-label">Talhões</div>
                <div class="sm-value">5</div>
              </div>
            </div>
            <div class="stat-mini-card">
              <div class="sm-icon green"><i class="bi bi-cash-coin"></i></div>
              <div class="sm-info">
                <div class="sm-label">Receitas</div>
                <div class="sm-value">1.245.500 Kz</div>
              </div>
            </div>
            <div class="stat-mini-card">
              <div class="sm-icon red"><i class="bi bi-cart"></i></div>
              <div class="sm-info">
                <div class="sm-label">Vendas</div>
                <div class="sm-value">875.200 Kz</div>
              </div>
            </div>
          </div>

          <!-- ── TABS VERTICAL ── -->
          <div class="cfg-card">
            <div class="cfg-card-header">
              <div class="cfg-card-header-left">
                <div class="cfg-card-icon green"><i class="bi bi-list-ul"></i></div>
                <div>
                  <div class="cfg-card-title">Histórico do Agricultor</div>
                  <div class="cfg-card-sub">Colheitas, insumos, produtos, talhões, receitas e vendas</div>
                </div>
              </div>
            </div>

            <!-- Tabs Nav (horizontal dentro do card) -->
            <div style="display:flex;gap:0;border-bottom:2px solid var(--border);background:var(--page-bg);padding:0 20px;overflow-x:auto;flex-shrink:0;">
              <button class="settings-nav-item active" data-tab="colheitas" style="width:auto;padding:12px 16px;font-size:12.5px;border-radius:0;border-bottom:2px solid transparent;margin-bottom:-2px;">
                <i class="bi bi-flower2"></i> Colheitas
              </button>
              <button class="settings-nav-item" data-tab="insumos" style="width:auto;padding:12px 16px;font-size:12.5px;border-radius:0;border-bottom:2px solid transparent;margin-bottom:-2px;">
                <i class="bi bi-box-seam"></i> Insumos
              </button>
              <button class="settings-nav-item" data-tab="produtos" style="width:auto;padding:12px 16px;font-size:12.5px;border-radius:0;border-bottom:2px solid transparent;margin-bottom:-2px;">
                <i class="bi bi-cube"></i> Produtos
              </button>
              <button class="settings-nav-item" data-tab="talhoes" style="width:auto;padding:12px 16px;font-size:12.5px;border-radius:0;border-bottom:2px solid transparent;margin-bottom:-2px;">
                <i class="bi bi-map"></i> Talhões
              </button>
              <button class="settings-nav-item" data-tab="receitas" style="width:auto;padding:12px 16px;font-size:12.5px;border-radius:0;border-bottom:2px solid transparent;margin-bottom:-2px;">
                <i class="bi bi-cash-coin"></i> Receitas
              </button>
              <button class="settings-nav-item" data-tab="vendas" style="width:auto;padding:12px 16px;font-size:12.5px;border-radius:0;border-bottom:2px solid transparent;margin-bottom:-2px;">
                <i class="bi bi-cart"></i> Vendas
              </button>
            </div>

            <!-- ── TAB: COLHEITAS ── -->
            <div class="settings-panel active" id="tab-colheitas" style="padding:20px;">
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:8px;">
                <h6 style="font-family:'Sora',sans-serif;font-weight:600;font-size:14px;margin:0;">
                  <i class="bi bi-flower2 me-2" style="color:var(--primary);"></i>Colheitas
                </h6>
                <button class="btn-green" style="padding:6px 14px;font-size:12px;"><i class="bi bi-plus-lg"></i> Nova Colheita</button>
              </div>
              <div class="tab-table-wrap">
                <table class="tab-table">
                  <thead>
                    <tr>
                      <th>Data</th>
                      <th>Produto</th>
                      <th>Quantidade</th>
                      <th>Unidade</th>
                      <th>Talhão</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>15/06/2024</td>
                      <td>Milho</td>
                      <td>1.250,00</td>
                      <td>kg</td>
                      <td>Talhão A1</td>
                      <td><span class="badge-status activo" style="font-size:11px;"><span class="dot"></span> Concluída</span></td>
                    </tr>
                    <tr>
                      <td>02/06/2024</td>
                      <td>Feijão</td>
                      <td>850,00</td>
                      <td>kg</td>
                      <td>Talhão B2</td>
                      <td><span class="badge-status activo" style="font-size:11px;"><span class="dot"></span> Concluída</span></td>
                    </tr>
                    <tr>
                      <td>20/05/2024</td>
                      <td>Mandioca</td>
                      <td>2.300,00</td>
                      <td>kg</td>
                      <td>Talhão C3</td>
                      <td><span class="badge-status pendente" style="font-size:11px;"><span class="dot"></span> Em andamento</span></td>
                    </tr>
                    <tr>
                      <td>10/04/2024</td>
                      <td>Batata Doce</td>
                      <td>1.100,00</td>
                      <td>kg</td>
                      <td>Talhão A1</td>
                      <td><span class="badge-status activo" style="font-size:11px;"><span class="dot"></span> Concluída</span></td>
                    </tr>
                    <tr>
                      <td>25/03/2024</td>
                      <td>Cebola</td>
                      <td>450,00</td>
                      <td>kg</td>
                      <td>Talhão B2</td>
                      <td><span class="badge-status inactivo" style="font-size:11px;"><span class="dot"></span> Cancelada</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- ── TAB: INSUMOS ── -->
            <div class="settings-panel" id="tab-insumos" style="padding:20px;">
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:8px;">
                <h6 style="font-family:'Sora',sans-serif;font-weight:600;font-size:14px;margin:0;">
                  <i class="bi bi-box-seam me-2" style="color:var(--primary);"></i>Insumos (Estoque)
                </h6>
                <button class="btn-green" style="padding:6px 14px;font-size:12px;"><i class="bi bi-plus-lg"></i> Novo Insumo</button>
              </div>
              <div class="tab-table-wrap">
                <table class="tab-table">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Categoria</th>
                      <th>Quantidade</th>
                      <th>Unidade</th>
                      <th>Mínimo</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Fertilizante NPK</td>
                      <td>Fertilizante</td>
                      <td>150,00</td>
                      <td>kg</td>
                      <td>100,00</td>
                      <td><span class="badge-status activo" style="font-size:11px;"><span class="dot"></span> Normal</span></td>
                    </tr>
                    <tr>
                      <td>Semente de Milho</td>
                      <td>Sementes</td>
                      <td>80,00</td>
                      <td>kg</td>
                      <td>50,00</td>
                      <td><span class="badge-status activo" style="font-size:11px;"><span class="dot"></span> Normal</span></td>
                    </tr>
                    <tr>
                      <td>Adubo Orgânico</td>
                      <td>Adubo</td>
                      <td>30,00</td>
                      <td>kg</td>
                      <td>40,00</td>
                      <td><span class="badge-status pendente" style="font-size:11px;"><span class="dot"></span> Baixo</span></td>
                    </tr>
                    <tr>
                      <td>Herbicida</td>
                      <td>Agroquímicos</td>
                      <td>8,00</td>
                      <td>L</td>
                      <td>10,00</td>
                      <td><span class="badge-status pendente" style="font-size:11px;"><span class="dot"></span> Baixo</span></td>
                    </tr>
                    <tr>
                      <td>Fungicida</td>
                      <td>Agroquímicos</td>
                      <td>25,00</td>
                      <td>L</td>
                      <td>15,00</td>
                      <td><span class="badge-status activo" style="font-size:11px;"><span class="dot"></span> Normal</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- ── TAB: PRODUTOS ── -->
            <div class="settings-panel" id="tab-produtos" style="padding:20px;">
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:8px;">
                <h6 style="font-family:'Sora',sans-serif;font-weight:600;font-size:14px;margin:0;">
                  <i class="bi bi-cube me-2" style="color:var(--primary);"></i>Produtos (Estoque)
                </h6>
                <button class="btn-green" style="padding:6px 14px;font-size:12px;"><i class="bi bi-plus-lg"></i> Novo Produto</button>
              </div>
              <div class="tab-table-wrap">
                <table class="tab-table">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Categoria</th>
                      <th>Quantidade</th>
                      <th>Unidade</th>
                      <th>Preço</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Milho Branco</td>
                      <td>Cereais</td>
                      <td>500,00</td>
                      <td>kg</td>
                      <td>250,00 Kz</td>
                      <td><span class="badge-status activo" style="font-size:11px;"><span class="dot"></span> Normal</span></td>
                    </tr>
                    <tr>
                      <td>Feijão Manteiga</td>
                      <td>Legumes</td>
                      <td>300,00</td>
                      <td>kg</td>
                      <td>450,00 Kz</td>
                      <td><span class="badge-status activo" style="font-size:11px;"><span class="dot"></span> Normal</span></td>
                    </tr>
                    <tr>
                      <td>Mandioca</td>
                      <td>Raízes</td>
                      <td>150,00</td>
                      <td>kg</td>
                      <td>180,00 Kz</td>
                      <td><span class="badge-status pendente" style="font-size:11px;"><span class="dot"></span> Baixo</span></td>
                    </tr>
                    <tr>
                      <td>Batata Doce</td>
                      <td>Raízes</td>
                      <td>400,00</td>
                      <td>kg</td>
                      <td>150,00 Kz</td>
                      <td><span class="badge-status activo" style="font-size:11px;"><span class="dot"></span> Normal</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- ── TAB: TALHÕES ── -->
            <div class="settings-panel" id="tab-talhoes" style="padding:20px;">
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:8px;">
                <h6 style="font-family:'Sora',sans-serif;font-weight:600;font-size:14px;margin:0;">
                  <i class="bi bi-map me-2" style="color:var(--primary);"></i>Talhões
                </h6>
                <button class="btn-green" style="padding:6px 14px;font-size:12px;"><i class="bi bi-plus-lg"></i> Novo Talhão</button>
              </div>
              <div class="tab-table-wrap">
                <table class="tab-table">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Área (ha)</th>
                      <th>Cultura</th>
                      <th>Localização</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Talhão A1</td>
                      <td>2,50</td>
                      <td>Milho</td>
                      <td>Zona Norte</td>
                      <td><span class="badge-status activo" style="font-size:11px;"><span class="dot"></span> Activo</span></td>
                    </tr>
                    <tr>
                      <td>Talhão B2</td>
                      <td>1,80</td>
                      <td>Feijão</td>
                      <td>Zona Sul</td>
                      <td><span class="badge-status activo" style="font-size:11px;"><span class="dot"></span> Activo</span></td>
                    </tr>
                    <tr>
                      <td>Talhão C3</td>
                      <td>3,20</td>
                      <td>Mandioca</td>
                      <td>Zona Este</td>
                      <td><span class="badge-status pendente" style="font-size:11px;"><span class="dot"></span> Em preparo</span></td>
                    </tr>
                    <tr>
                      <td>Talhão D4</td>
                      <td>1,50</td>
                      <td>Batata Doce</td>
                      <td>Zona Oeste</td>
                      <td><span class="badge-status inactivo" style="font-size:11px;"><span class="dot"></span> Inactivo</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- ── TAB: RECEITAS ── -->
            <div class="settings-panel" id="tab-receitas" style="padding:20px;">
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:8px;">
                <h6 style="font-family:'Sora',sans-serif;font-weight:600;font-size:14px;margin:0;">
                  <i class="bi bi-cash-coin me-2" style="color:var(--primary);"></i>Receitas
                </h6>
                <button class="btn-green" style="padding:6px 14px;font-size:12px;"><i class="bi bi-plus-lg"></i> Nova Receita</button>
              </div>
              <div class="tab-table-wrap">
                <table class="tab-table">
                  <thead>
                    <tr>
                      <th>Data</th>
                      <th>Descrição</th>
                      <th>Valor</th>
                      <th>Fonte</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>10/06/2024</td>
                      <td>Venda de Milho</td>
                      <td><strong>125.000,00 Kz</strong></td>
                      <td>Cooperativa</td>
                      <td><span class="badge-status activo" style="font-size:11px;"><span class="dot"></span> Recebido</span></td>
                    </tr>
                    <tr>
                      <td>28/05/2024</td>
                      <td>Venda de Feijão</td>
                      <td><strong>135.000,00 Kz</strong></td>
                      <td>Mercado Local</td>
                      <td><span class="badge-status activo" style="font-size:11px;"><span class="dot"></span> Recebido</span></td>
                    </tr>
                    <tr>
                      <td>15/05/2024</td>
                      <td>Subsídio Agrícola</td>
                      <td><strong>500.000,00 Kz</strong></td>
                      <td>Governo</td>
                      <td><span class="badge-status activo" style="font-size:11px;"><span class="dot"></span> Recebido</span></td>
                    </tr>
                    <tr>
                      <td>02/04/2024</td>
                      <td>Venda de Mandioca</td>
                      <td><strong>180.500,00 Kz</strong></td>
                      <td>Cooperativa</td>
                      <td><span class="badge-status pendente" style="font-size:11px;"><span class="dot"></span> Pendente</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tab-total">
                <strong>Total: 1.245.500,00 Kz</strong>
              </div>
            </div>

            <!-- ── TAB: VENDAS ── -->
            <div class="settings-panel" id="tab-vendas" style="padding:20px;">
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:8px;">
                <h6 style="font-family:'Sora',sans-serif;font-weight:600;font-size:14px;margin:0;">
                  <i class="bi bi-cart me-2" style="color:var(--primary);"></i>Vendas
                </h6>
                <button class="btn-green" style="padding:6px 14px;font-size:12px;"><i class="bi bi-plus-lg"></i> Nova Venda</button>
              </div>
              <div class="tab-table-wrap">
                <table class="tab-table">
                  <thead>
                    <tr>
                      <th>Data</th>
                      <th>Produto</th>
                      <th>Quantidade</th>
                      <th>Valor</th>
                      <th>Cliente</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>08/06/2024</td>
                      <td>Milho</td>
                      <td>500,00</td>
                      <td><strong>125.000,00 Kz</strong></td>
                      <td>Cooperativa Viana</td>
                      <td><span class="badge-status activo" style="font-size:11px;"><span class="dot"></span> Concluída</span></td>
                    </tr>
                    <tr>
                      <td>25/05/2024</td>
                      <td>Feijão</td>
                      <td>300,00</td>
                      <td><strong>135.000,00 Kz</strong></td>
                      <td>Mercado Central</td>
                      <td><span class="badge-status activo" style="font-size:11px;"><span class="dot"></span> Concluída</span></td>
                    </tr>
                    <tr>
                      <td>10/05/2024</td>
                      <td>Batata Doce</td>
                      <td>200,00</td>
                      <td><strong>30.000,00 Kz</strong></td>
                      <td>Feirante Local</td>
                      <td><span class="badge-status pendente" style="font-size:11px;"><span class="dot"></span> Pendente</span></td>
                    </tr>
                    <tr>
                      <td>28/03/2024</td>
                      <td>Mandioca</td>
                      <td>450,00</td>
                      <td><strong>81.000,00 Kz</strong></td>
                      <td>Processadora</td>
                      <td><span class="badge-status activo" style="font-size:11px;"><span class="dot"></span> Concluída</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tab-total">
                <strong>Total: 875.200,00 Kz</strong>
              </div>
            </div>

          </div>
          <!-- /cfg-card -->

        </div>
        <!-- /settings-content -->

      </div>
      <!-- /settings-wrap -->

    </div>
  </main>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    /* ══════════════════════════════════════
       SIDEBAR TOGGLE (3 estados)
    ══════════════════════════════════════ */
    const body = document.body;
    let sideState = 0;

    document.getElementById('sidebarToggle').addEventListener('click', () => {
      sideState = (sideState + 1) % 3;
      body.classList.remove('icons-only', 'sidebar-hidden');
      if (sideState === 1) body.classList.add('icons-only');
      if (sideState === 2) body.classList.add('sidebar-hidden');
    });

    /* ══════════════════════════════════════
       DARK MODE
    ══════════════════════════════════════ */
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const themeLabel = document.getElementById('themeLabel');
    let darkMode = false;

    themeToggle.addEventListener('click', function (e) {
      e.preventDefault();
      darkMode = !darkMode;
      body.classList.toggle('dark-mode', darkMode);
      themeIcon.className = darkMode ? 'bi bi-sun-fill' : 'bi bi-moon-stars-fill';
      themeLabel.textContent = darkMode ? 'Modo Claro' : 'Modo Escuro';
    });

    /* ══════════════════════════════════════
       TABS (horizontal dentro do card)
    ══════════════════════════════════════ */
    document.querySelectorAll('.settings-nav-item[data-tab]').forEach(btn => {
      btn.addEventListener('click', function (e) {
        const tab = this.dataset.tab;

        // Remove active de todos os tabs
        document.querySelectorAll('.settings-nav-item[data-tab]').forEach(b => {
          b.classList.remove('active');
        });
        this.classList.add('active');

        // Mostra o painel correspondente
        document.querySelectorAll('.settings-panel').forEach(p => {
          p.classList.remove('active');
        });
        const panel = document.getElementById('tab-' + tab);
        if (panel) panel.classList.add('active');
      });
    });

    /* ══════════════════════════════════════
       NAV ACTIVE SIDEBAR
    ══════════════════════════════════════ */
    document.querySelectorAll('.nav-item-link').forEach(link => {
      link.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (!href || href === '#') {
          e.preventDefault();
        }
        document.querySelectorAll('.nav-item-link').forEach(l => l.classList.remove('active'));
        this.classList.add('active');
        const label = this.dataset.label || this.querySelector('.nav-label')?.textContent || '';
        document.querySelector('.topbar-title')?.textContent || '';
      });
    });
  </script>

</body>

</html>
