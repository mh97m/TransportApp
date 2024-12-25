export default function Pagination({ links }) {
    return (
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div
                    class="dataTables_info"
                    id="datatable_info"
                    role="status"
                    aria-live="polite"
                >
                    نمایش 1 تا 10 از 12 ورودی ها
                </div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div
                    class="dataTables_paginate paging_simple_numbers"
                    id="datatable_paginate"
                >
                    <ul class="pagination">
                        <li
                            class="paginate_button page-item previous disabled"
                            id="datatable_previous"
                        >
                            <a
                                href="#"
                                aria-controls="datatable"
                                data-dt-idx="0"
                                tabindex="0"
                                class="page-link"
                            >
                                قبل
                            </a>
                        </li>
                        <li class="paginate_button page-item active">
                            <a
                                href="#"
                                aria-controls="datatable"
                                data-dt-idx="1"
                                tabindex="0"
                                class="page-link"
                            >
                                1
                            </a>
                        </li>
                        <li class="paginate_button page-item">
                            <a
                                href="#"
                                aria-controls="datatable"
                                data-dt-idx="2"
                                tabindex="0"
                                class="page-link"
                            >
                                2
                            </a>
                        </li>
                        <li
                            class="paginate_button page-item next"
                            id="datatable_next"
                        >
                            <a
                                href="#"
                                aria-controls="datatable"
                                data-dt-idx="3"
                                tabindex="0"
                                class="page-link"
                            >
                                بعد
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        // <nav className="text-center mt-4">
        //   {links.map((link) => (
        //     <Link
        //       preserveScroll
        //       href={link.url || ""}
        //       key={link.label}
        //       className={
        //         "inline-block py-2 px-3 rounded-lg text-gray-200 text-xs " +
        //         (link.active ? "bg-gray-950 " : " ") +
        //         (!link.url
        //           ? "!text-gray-500 cursor-not-allowed "
        //           : "hover:bg-gray-950")
        //       }
        //       dangerouslySetInnerHTML={{ __html: link.label }}
        //     ></Link>
        //   ))}
        // </nav>
    );
}
