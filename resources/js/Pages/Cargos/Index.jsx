import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { useState } from 'react';

export default function CargoDetails({ cargo, orders }) {

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
                        <div className="card-box" style={{
                            borderRadius: '10px',
                            boxShadow: '0px 0px 7px rgba(0, 0, 0, 0.342)',
                        }}>
                            <h3 className="m-0 d-print-none">مشخصات بار</h3>
                            <table className="table mt-4 table-centered">
                                <tbody>
                                    <tr>
                                        <td>شناسه بار</td>
                                        <td>{cargo.id}</td>
                                    </tr>
                                    <tr>
                                        <td>تعداد بازدید</td>
                                        <td>{cargo.viewsCount}</td>
                                    </tr>
                                    <tr>
                                        <td>مبدا</td>
                                        <td>{`${cargo.originProvince} - ${cargo.originCity}`}</td>
                                    </tr>
                                    <tr>
                                        <td>مقصد</td>
                                        <td>{`${cargo.destinationProvince} - ${cargo.destinationCity}`}</td>
                                    </tr>
                                    <tr>
                                        <td>قیمت</td>
                                        <td>{new Intl.NumberFormat('fa-IR').format(cargo.price)} تومان</td>
                                    </tr>
                                    <tr>
                                        <td>ماشین</td>
                                        <td>{cargo.carType}</td>
                                    </tr>
                                    <tr>
                                        <td>وزن</td>
                                        <td>{cargo.weight}</td>
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
                {orders?.map((order) => (
                    <div className="col-10">
                        <div className="card-box" style={{
                            borderRadius: '10px',
                            boxShadow: '0px 0px 7px rgba(0, 0, 0, 0.342)',
                        }}>
                            <h4 className="m-0 d-print-none">مشخصات راننده</h4>
                            <div className="clearfix pt-3">
                                <h4 className="text-muted">
                                    نام: {order?.driver?.name || 'ناموجود'}
                                </h4>
                                <p className="text-muted">
                                    شماره همراه: {order?.driver?.mobile || 'ناموجود'}
                                </p>
                                <p className="text-muted">
                                    نوع ماشین: {order?.driverDetails?.carType || 'ناموجود'}
                                </p>
                            </div>
                            <div className="hidden-print mt-4">
                                <div className="text-right d-print-none">
                                    <div className={`alert alert-${order?.orderStatus?.color} col-12 d-flex justify-content-center`}>
                                        {order?.orderStatus?.description}
                                    </div>
                                    {order?.ownerStatus === null && (
                                        <>
                                            <button
                                                className="btn btn-success text-white mr-2"
                                                onClick={() => handleChangeOrderStatus(order.id, true)}
                                            >
                                                قبول درخواست
                                            </button>
                                            <button
                                                className="btn btn-danger text-white"
                                                onClick={() => handleChangeOrderStatus(order.id, false)}
                                            >
                                                رد درخواست
                                            </button>
                                        </>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>
                ))}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
