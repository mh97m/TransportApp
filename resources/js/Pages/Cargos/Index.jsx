import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { useState } from 'react';

export default function CargoDetails({ cargo }) {

    const [sessionMessage, setSessionMessage] = useState(null);

    const handleChangeOrderStatus = (orderId, isAccepted) => {
        const formData = {
            isAccepted,
        };

        axios
            .post(route('orders.changeStatus', orderId), formData)
            .then((response) => {
                setSessionMessage({
                    message: response.data.message || 'وضعیت با موفقیت ثبت شد.',
                    title: 'عالیه',
                    color: 'success',
                });
            })
            .catch((error) => {
                console.error('Error updating status:', error);
            });
    };

    return (
        <AuthenticatedLayout>
            <div className="container">
                {/* Cargo Details */}
                <div className="row mt-4 mb-2 mb-lg-0">
                    <div className="col-12">
                        <div className="card-box">
                            <h3 className="m-0 d-print-none">مشخصات بار</h3>
                            <table className="table mt-4 table-centered">
                                <tbody>
                                    <tr>
                                        <td>شناسه بار</td>
                                        <td>{cargo.ulid}</td>
                                    </tr>
                                    <tr>
                                        <td>تعداد بازدید</td>
                                        <td>{cargo.viewsCount}</td>
                                    </tr>
                                    <tr>
                                        <td>مبدا</td>
                                        <td>{`${cargo.origin_province?.title} - ${cargo.origin_city?.title}`}</td>
                                    </tr>
                                    <tr>
                                        <td>مقصد</td>
                                        <td>{`${cargo.destination_province?.title} - ${cargo.destination_city?.title}`}</td>
                                    </tr>
                                    <tr>
                                        <td>قیمت</td>
                                        <td>{new Intl.NumberFormat('fa-IR').format(cargo.price)} تومان</td>
                                    </tr>
                                    <tr>
                                        <td>ماشین</td>
                                        <td>{cargo.car_type?.title}</td>
                                    </tr>
                                    <tr>
                                        <td>وزن</td>
                                        <td>{new Intl.NumberFormat('fa-IR').format(cargo.weight)}</td>
                                    </tr>
                                    <tr>
                                        <td>توضیحات</td>
                                        <td>{cargo.description}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {/* Driver Details */}
                <div className="row">
                    <div className="col-12">
                        <div className="card-box">
                            <h4 className="m-0 d-print-none">مشخصات راننده</h4>
                            <div className="clearfix pt-3">
                                <h4 className="text-muted">
                                    نام: {cargo.orders?.[0]?.driver?.title || 'ناموجود'}
                                </h4>
                                <p className="text-muted">
                                    شماره همراه: {cargo.orders?.[0]?.driver?.mobile || 'ناموجود'}
                                </p>
                                <p className="text-muted">
                                    نوع ماشین: {cargo.orders?.[0]?.driver?.details?.carType?.title || 'ناموجود'}
                                </p>
                                <p className="text-muted">
                                    نوع باربر: {cargo.orders?.[0]?.driver?.details?.loaderType?.title || 'ناموجود'}
                                </p>
                            </div>
                            <div className="hidden-print mt-4">
                                <div className="text-right d-print-none">
                                    {cargo.orders?.[0]?.owner_status === null ? (
                                        <>
                                            <button
                                                className="btn btn-success text-white"
                                                onClick={() => handleChangeOrderStatus(cargo.orders[0].id, true)}
                                            >
                                                قبول درخواست
                                            </button>
                                            <button
                                                className="btn btn-danger text-white"
                                                onClick={() => handleChangeOrderStatus(cargo.orders[0].id, false)}
                                            >
                                                رد درخواست
                                            </button>
                                        </>
                                    ) : (
                                        <div className="alert alert-success col-12 d-flex justify-content-center">
                                            تایید شده است
                                        </div>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
