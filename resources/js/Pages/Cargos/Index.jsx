import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { router } from '@inertiajs/react';

export default function CargoDetails({ cargo, orders }) {
    const handleChangeOrderStatus = (orderId, isAccepted) => {
        router.post(route('orders.updateOrderStatus', orderId), {
            isAccepted: isAccepted,
        });
    };

    return (
        <AuthenticatedLayout>
            <div className="container">
                {/* Cargo Details */}
                <div className="row mb-lg-0 mb-2 mt-4">
                    <div className="col-12">
                        <div
                            className="card-box"
                            style={{
                                borderRadius: '10px',
                                boxShadow: '0px 0px 7px rgba(0, 0, 0, 0.342)',
                            }}
                        >
                            <h3 className="d-print-none m-0">مشخصات بار</h3>
                            <table className="table-centered mt-4 table">
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
                                        <td>{cargo.price} تومان</td>
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
                            <div
                                className="card-box"
                                style={{
                                    borderRadius: '10px',
                                    boxShadow:
                                        '0px 0px 7px rgba(0, 0, 0, 0.342)',
                                }}
                            >
                                <h4 className="d-print-none m-0">
                                    مشخصات راننده
                                </h4>
                                <div className="clearfix pt-3">
                                    <h4 className="text-muted">
                                        نام: {order?.driver?.name || 'ناموجود'}
                                    </h4>
                                    <p className="text-muted">
                                        شماره همراه:{' '}
                                        {order?.driver?.mobile || 'ناموجود'}
                                    </p>
                                    <p className="text-muted">
                                        نوع ماشین:{' '}
                                        {order?.driverDetails?.carType ||
                                            'ناموجود'}
                                    </p>
                                </div>
                                <div className="hidden-print mt-4">
                                    <div className="d-print-none text-right">
                                        <div
                                            className={`alert alert-${order?.orderStatus?.color} col-12 d-flex justify-content-center`}
                                        >
                                            {order?.orderStatus?.description}
                                        </div>
                                        {order?.ownerStatus === null ? (
                                            <>
                                                <button
                                                    className="btn btn-success mr-2 text-white"
                                                    onClick={() =>
                                                        handleChangeOrderStatus(
                                                            order.ulid,
                                                            true,
                                                        )
                                                    }
                                                >
                                                    قبول درخواست
                                                </button>
                                                <button
                                                    className="btn btn-danger text-white"
                                                    onClick={() =>
                                                        handleChangeOrderStatus(
                                                            order.ulid,
                                                            false,
                                                        )
                                                    }
                                                >
                                                    رد درخواست
                                                </button>
                                            </>
                                        ) : (
                                            <h4 className="d-flex justify-content-center">
                                            <span
                                                className={"badge badge-" + (order?.ownerStatus ? "success" : "error") + " col-8"}
                                            >
                                                {
                                                order?.ownerStatus ? "بار تایید شده است" : "بار رد شده است"
                                                }
                                            </span>
                                            </h4>
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
