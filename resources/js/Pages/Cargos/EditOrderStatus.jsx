import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, router, useForm } from '@inertiajs/react';
import CargoCart from './CargoCart';

export default function EditOrderStatus({ auth, order, orderStatuses, cargo }) {
    const { data, setData, post, processing } = useForm({
        order_status_id: order.order_status_id,
    });

    const changeOrderStatus = (orderStatusId) => {
        router.post(
            route('cargos.updateOrderStatus', {
                orderId: order.ulid,
                orderStatusId: orderStatusId,
            }),
        );
    };

    return (
        <AuthenticatedLayout>
            <Head title="ثبت وضعیت" />
            <div className="row mt-3">
                <CargoCart cargo={cargo} isAnimate={true}>
                    <div className="row mt-4">
                        {orderStatuses.map((status) => (
                            <button
                            key={status.ulid}
                                type="button"
                                className={`btn btn-block btn-outline-${status.color}`}
                                onClick={() =>
                                    changeOrderStatus(
                                        status.ulid,
                                    )
                                }
                            >
                                {status.description}
                            </button>
                        ))}
                    </div>
                </CargoCart>
            </div>
        </AuthenticatedLayout>
    );
}
