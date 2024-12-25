import Navbar from './Navbar';
import Footer from './Footer';
import { usePage } from '@inertiajs/react';
import Swal from 'sweetalert2';

export default function AuthenticatedLayout({ header, children }) {
    const { alert } = usePage().props;

    if (alert && alert.text) {
        const swalAlert = {
            icon: alert.icon,
            text: alert.text,
            timer: alert.timer,
            confirmButtonText: alert.confirmButtonText,
        };

        if (alert.title) {
            swalAlert.title = alert.title;
        }

        if (alert.footer) {
            swalAlert.footer = alert.footer;
        }

        Swal.fire(swalAlert);
    }

    return (
        <div id="wrapper">
            <Navbar />

            <div className="content-page">
                <div className="content">
                    {children}
                </div>

                <Footer />
            </div>
        </div>
    );
}
