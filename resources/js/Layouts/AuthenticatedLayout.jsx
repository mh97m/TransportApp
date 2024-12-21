import Navbar from './Navbar';
import Footer from './Footer';

export default function AuthenticatedLayout({ header, children }) {
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
