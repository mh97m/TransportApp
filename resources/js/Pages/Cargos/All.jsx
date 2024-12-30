import Pagination from '@/Components/Pagination';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Link } from '@inertiajs/react';
import CargoCart from './CargoCart';

export default function All({ cargos }) {
    return (
        <AuthenticatedLayout>
            <div className="container-fluid">
                <div className="row mt-3">
                    {cargos.data.map((cargo) => (
                        <CargoCart
                            key={cargo.id}
                            cargo={cargo}
                            footer={
                                <div className="card-footer0 p-0">
                                    <Link
                                        href={route('cargos.index', cargo.ulid)}
                                        className="btn btn-primary btn-lg btn-block text-uppercase text-white"
                                        style={{
                                            borderRadius: '10px',
                                            borderTopLeftRadius: '0px',
                                            borderTopRightRadius: '0px',
                                            backgroundColor: '#598bc4',
                                        }}
                                    >
                                        <i className="fas fa-phone-alt"></i>
                                        مشاهده جزییات بار
                                    </Link>
                                </div>
                            }
                        />
                    ))}
                </div>

                <Pagination links={cargos.links} />
            </div>
        </AuthenticatedLayout>
    );
}
