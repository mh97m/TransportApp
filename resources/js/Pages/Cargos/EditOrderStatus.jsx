import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, router, useForm } from '@inertiajs/react';
import React, { useEffect } from 'react';

export default function EditOrderStatus({ auth, order, orderStatuses, cargo }) {
    const { data, setData, post, processing } = useForm({
        order_status_id: order.order_status_id,
    });

    const changeOrderStatus = (orderStatusId) => {
        router.post(route('cargos.updateOrderStatus', { orderId: order.ulid , orderStatusId: orderStatusId }));
    };

    return (
        <AuthenticatedLayout>
            <Head title="ثبت وضعیت" />

            <div className="py-12">
                <div className="container-fluid">
                    <div className="row mt-3">
                        <div className="col-lg-12">
                            <div className="text-center card-box border border-primary" style={{ borderRadius: '8px' }}>
                                <div className="dropdown float-right">
                                    <a href="#" className="dropdown-toggle card-drop arrow-none" data-toggle="dropdown" aria-expanded="false">
                                        <div><i className="mdi mdi-dots-horizontal h3 m-0 text-muted"></i></div>
                                    </a>
                                    <div className="dropdown-menu dropdown-menu-right">
                                        <a className="dropdown-item" href="#">گزارش تخلف</a>
                                    </div>
                                </div>
                                <div className="clearfix"></div>
                                <div className="member-card">
                                    <h4 className="mb-1">مبدا: {cargo.origin_province.title} - {cargo.origin_city.title}</h4>

                                    <div className="h4 mt-2">
                                        <i className="fe-arrow-down" style={{ color: '#598bc4' }}></i>
                                    </div>

                                    <h4 className="mb-1">مقصد: {cargo.destination_province.title} - {cargo.destination_city.title}</h4>

                                    <p className="text-muted pt-4">
                                        {/* <b>ماشین</b> : {cargo.carType.title} - <b>باربر</b> : {cargo.loaderType.title} */}
                                    </p>

                                    <p className="text-muted pt-3">
                                        <b>توضیحات</b> : {cargo.description}
                                    </p>

                                    <div className="mt-4">
                                        <div className="row">
                                            <div className="col-6">
                                                <div className="mt-2 mb-1">
                                                    <h4 className="mb-1">{new Intl.NumberFormat().format(cargo.price)}</h4>
                                                    <p className="mb-0 text-muted">قیمت</p>
                                                </div>
                                            </div>
                                            <div className="col-6">
                                                <div className="mt-2">
                                                    <h4 className="mb-1">{new Intl.NumberFormat().format(cargo.weight)}</h4>
                                                    <p className="mb-0 text-muted">وزن</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="row pt-4">
                                        {orderStatuses.map((status) => (
                                            <div
                                                key={status.ulid}
                                                className={`alert alert-${status.color} col-12 d-flex justify-content-center`}
                                                style={{ cursor: 'pointer' }}
                                                onClick={() => changeOrderStatus(status.ulid)}
                                            >
                                                {status.description}
                                            </div>
                                        ))}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
