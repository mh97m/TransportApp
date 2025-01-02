import Pagination from '@/Components/Pagination';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Link } from '@inertiajs/react';
import CargoCart from '../Cargos/CargoCart';

export default function Orders({ orders }) {
    return (
        <AuthenticatedLayout>
            <div className="container-fluid">
                <div className="row mt-3">
                    {orders.data.map((order) => (
                        <CargoCart
                            key={order.ulid}
                            cargo={order.cargo}
                            footer={
                                <>
                                    {order.cargo?.completed_at && (
                                        <div className="d-flex justify-content-center">
                                            <span className="alert alert-success col-8 text-center">
                                                بار تایید شده است
                                            </span>
                                        </div>
                                    )}
                                </>
                            }
                        />
                    ))}
                </div>

                <Pagination links={orders.links} />
            </div>
        </AuthenticatedLayout>
    );
}
