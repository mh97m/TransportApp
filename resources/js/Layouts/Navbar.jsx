import { Link, usePage } from '@inertiajs/react';
import { useClickAway } from '@uidotdev/usehooks';
import { useState } from 'react';

export default function Navbar() {
    const user = usePage().props.auth.user;
    const roles = usePage().props.auth.roles;
    const [showNotifications, setShowNotifications] = useState(false);
    const showNotificationsRef = useClickAway(() => {
        setShowNotifications(false);
    });
    const [showProfileDropdown, setShowProfileDropdown] = useState(false);
    const showProfileDropdownRef = useClickAway(() => {
        setShowProfileDropdown(false);
    });

    const notifications = [
        {
            id: 1,
            icon: 'mdi-comment-account-outline',
            bg: 'bg-success',
            message: 'محمد فلاح, مدیر جدید بخش طراحی',
            time: '3 دقیقه پیش',
        },
        {
            id: 2,
            icon: 'mdi-settings-outline',
            bg: 'bg-primary',
            message: 'تنظیمات جدید',
            detail: 'امکانات جدید در تنظیمات قابل دسترسی',
            time: '',
        },
        {
            id: 3,
            icon: 'mdi-bell-outline',
            bg: 'bg-warning',
            message: 'آپدیت ها',
            detail: 'دو تا آپدیت جدید قابل دسترسی هست',
            time: '',
        },
        {
            id: 4,
            icon: '',
            bg: '',
            message: 'امید حسین آبادی',
            detail: 'اووو ! این مدیر طراحی خوب و عالی به نظر می رسد',
            time: '',
        },
        {
            id: 5,
            icon: 'mdi-account-plus',
            bg: 'bg-danger',
            message: 'کاربر جدید',
            detail: 'شما 10 پیام خوانده نشده دارید',
            time: '',
        },
        {
            id: 6,
            icon: 'mdi-comment-account-outline',
            bg: 'bg-info',
            message: 'علی سهیلی در مورد مدیر نظر داد',
            time: '4 روز پیش',
        },
        {
            id: 7,
            icon: 'mdi-heart',
            bg: 'bg-secondary',
            message: 'هومن شلیلوند لایک کرد',
            detail: 'مدیر',
            time: '13 روز پیش',
        },
    ];

    return (
        <div className="navbar-custom">
            <ul className="list-unstyled topnav-menu float-right mb-0">
                <li className="dropdown notification-list">
                    <a
                        className="nav-link dropdown-toggle waves-effect waves-light"
                        ref={showNotificationsRef}
                        onClick={() => setShowNotifications(!showNotifications)}
                    >
                        <i className="dripicons-bell noti-icon"></i>
                        <span className="badge badge-pink rounded-circle noti-icon-badge">
                            4
                        </span>
                    </a>
                    {showNotifications && (
                        <div className="dropdown-menu dropdown-menu-right dropdown-lg show mt-1">
                            <div className="dropdown-header noti-title">
                                <h5 className="text-overflow m-0">
                                    <span className="float-right">
                                        <span className="badge badge-danger float-right">
                                            5
                                        </span>
                                    </span>
                                    اعلان ها
                                </h5>
                            </div>
                            <div className="slimscroll noti-scroll">
                                {notifications.map((notification) => (
                                    <div
                                        key={notification.id}
                                        className="dropdown-item notify-item"
                                    >
                                        <div
                                            className={`notify-icon ${notification.bg}`}
                                        >
                                            <i
                                                className={`mdi ${notification.icon}`}
                                            ></i>
                                        </div>
                                        <p className="notify-details">
                                            {notification.message}
                                            {notification.detail && (
                                                <small className="text-muted">
                                                    {notification.detail}
                                                </small>
                                            )}
                                            {notification.time && (
                                                <small className="text-muted">
                                                    {notification.time}
                                                </small>
                                            )}
                                        </p>
                                    </div>
                                ))}
                            </div>
                            <button className="dropdown-item text-primary notify-item notify-all text-center">
                                مشاهده همه
                                <i className="fi-arrow-right"></i>
                            </button>
                        </div>
                    )}
                </li>

                <li
                    className="dropdown notification-list"
                    ref={showProfileDropdownRef}
                >
                    <a
                        className="nav-link dropdown-toggle nav-user waves-effect waves-light mr-0"
                        onClick={() =>
                            setShowProfileDropdown(!showProfileDropdown)
                        }
                    >
                        <img
                            src="/assets/images/user.jpg"
                            alt="user-image"
                            className="rounded-circle"
                        />
                        <span className="pro-user-name ml-1">
                            {user.title}{' '}
                            <i className="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    {showProfileDropdown && (
                        <div
                            className="dropdown-menu dropdown-menu-right profile-dropdown show mt-1"
                            style={{ width: '200px' }}
                        >
                            <div className="dropdown-header noti-title">
                                <h6 className="text-overflow m-0">
                                    خوش آمدید !
                                </h6>
                            </div>

                            <Link
                                className="dropdown-item notify-item"
                                href={route('profile.edit')}
                            >
                                <i className="fe-user"></i>
                                <span>پروفایل</span>
                            </Link>

                            {roles.includes('driver') && (
                                <Link
                                    className="dropdown-item notify-item"
                                    href={route('orders.all')}
                                >
                                    <i className="fe-settings"></i>
                                    <span>تاریخچه بار های من</span>
                                </Link>
                            )}

                            {roles.includes('owner') && (
                                <>
                                    <Link
                                        className="dropdown-item notify-item"
                                        href={route('cargos.all')}
                                    >
                                        <i className="fe-settings"></i>
                                        <span>تاریخچه اعلام بار های من</span>
                                    </Link>
                                    <Link
                                        className="dropdown-item notify-item"
                                        href={route('cargos.create')}
                                    >
                                        <i className="fe-box"></i>
                                        <span>اعلام بار</span>
                                    </Link>
                                </>
                            )}

                            <div className="dropdown-divider"></div>

                            <Link
                                className="dropdown-item notify-item"
                                method="post"
                                href={route('logout')}
                            >
                                <i className="fe-log-out"></i>
                                <span>خروج</span>
                            </Link>
                        </div>
                    )}
                </li>
            </ul>
        </div>
    );
}
