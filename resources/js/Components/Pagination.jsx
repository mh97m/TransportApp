import { Link } from '@inertiajs/react';

export default function Pagination({ links }) {
    return (
        <div className="row">
            <div className="col-sm-12 col-md-5">
                <div
                    className="dataTables_info"
                    role="status"
                    // aria-live="polite"
                >
                    {/* Customize this part if you want to display additional meta information */}
                    نمایش صفحه {links.find((link) => link.active)?.label || 1}{' '}
                    از {links.length - 2}
                </div>
            </div>
            <div className="col-sm-12 col-md-7">
                <div className="dataTables_paginate paging_simple_numbers" style={{
                width : "100px !important",
                height : "100px !important",
            }}>
                    <ul className="pagination">
                        {links.map((link, index) => (
                            <li
                                key={index}
                                className={`paginate_button page-item ${
                                    link.active ? 'active' : ''
                                } ${link.url === null ? 'disabled' : ''}`}
                            >
                                {link.url ? (
                                    <Link
                                        preserveScroll
                                        href={link.url}
                                        className="page-link"
                                        dangerouslySetInnerHTML={{
                                            __html: link.label,
                                        }}
                                    />
                                ) : (
                                    <span
                                        className="page-link"
                                        dangerouslySetInnerHTML={{
                                            __html: link.label,
                                        }}
                                    />
                                )}
                            </li>
                        ))}
                    </ul>
                </div>
            </div>
        </div>
    );
}
