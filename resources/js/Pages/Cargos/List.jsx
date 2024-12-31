import Pagination from '@/Components/Pagination';
import SearchSelect from '@/Components/SearchSelect';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { router } from '@inertiajs/react';
import { useState } from 'react';
import CargoCart from './CargoCart';

export default function List({ queryParams, cargos, provinces }) {
    const getOptionByValue = (options, value) => {
        return options.find((option) => option.value === value) || null;
    };

    const [queryParamsState, setQueryParamsState] = useState(queryParams || {});
    const [originProvince, setOriginProvince] = useState(
        getOptionByValue(provinces, parseInt(queryParams?.originProvinceId)) ||
            null,
    );
    const [destinationProvince, setDestinationProvince] = useState(
        getOptionByValue(
            provinces,
            parseInt(queryParams?.destinationProvinceId),
        ) || null,
    );

    const handleSelectChange = (name, selectedOption) => {
        setQueryParamsState((prev) => {
            const updatedParams = { ...prev, [name]: selectedOption?.value };
            if (!selectedOption?.value) {
                delete updatedParams[name];
            }
            return updatedParams;
        });
    };

    const setQueryParams = (name, value) => {
        setQueryParamsState((prev) => {
            const updatedParams = { ...prev, [name]: value };
            if (!value) {
                delete updatedParams[name];
            }
            return updatedParams;
        });
    };

    const search = () => {
        router.get(route('cargos.list'), queryParamsState, {
            only: ['cargos', 'queryParams'],
        });
    };

    const onKeyPress = (name, e) => {
        if (e.key !== 'Enter') return;
        search(name, e.target.value);
    };

    const sortChanged = (name) => {
        if (name === queryParams.sort_field) {
            if (queryParams.sort_direction === 'asc') {
                queryParams.sort_direction = 'desc';
            } else {
                queryParams.sort_direction = 'asc';
            }
        } else {
            queryParams.sort_field = name;
            queryParams.sort_direction = 'asc';
        }
        router.get(route('cargos.list'), queryParams);
    };

    const makeOrder = (cargoId) => {
        router.post(route('cargos.createOrder', { cargo: cargoId }));
    };
    return (
        <AuthenticatedLayout>
            <div className="container-fluid">
                <div className="row mb-2 mt-4">
                    <div className="col">
                        <form
                            onSubmit={(e) => {
                                e.preventDefault();
                                search();
                            }}
                        >
                            <div className="form-row">
                                <SearchSelect
                                    mdLength={6}
                                    smLength={6}
                                    label="استان مبدا"
                                    id="originProvinceId"
                                    name="originProvinceId"
                                    options={provinces}
                                    value={originProvince}
                                    onChange={(selected) => {
                                        setOriginProvince(selected);

                                        handleSelectChange(
                                            'originProvinceId',
                                            selected,
                                        );
                                    }}
                                />
                                <SearchSelect
                                    mdLength={6}
                                    smLength={6}
                                    label="استان مقصد"
                                    id="destinationProvinceId"
                                    name="destinationProvinceId"
                                    options={provinces}
                                    value={destinationProvince}
                                    onChange={(selected) => {
                                        setDestinationProvince(selected);
                                        handleSelectChange(
                                            'destinationProvinceId',
                                            selected,
                                        );
                                    }}
                                />
                                {/* <div className="form-group col-6 mb-2">
                                    <label htmlFor="originProvince">
                                        استان مبدا
                                    </label>
                                    <select
                                        className="form-control text-uppercase text-2"
                                        id="originProvince"
                                        value={
                                            queryParamsState?.originProvinceId
                                        }
                                        onChange={(e) =>
                                            setQueryParams(
                                                'originProvinceId',
                                                e.target.value,
                                            )
                                        }
                                    >
                                        <option value="">همه استان ها</option>
                                        {provinces.map((province) => (
                                            <option
                                                key={province.id}
                                                value={province.id}
                                            >
                                                {province.title}
                                            </option>
                                        ))}
                                    </select>
                                </div>
                                <div className="form-group col-6 mb-2">
                                    <label htmlFor="originProvince">
                                        استان مقصد
                                    </label>
                                    <select
                                        className="form-control text-uppercase text-2"
                                        id="originProvince"
                                        value={
                                            queryParamsState?.destinationProvinceId
                                        }
                                        onChange={(e) =>
                                            setQueryParams(
                                                'destinationProvinceId',
                                                e.target.value,
                                            )
                                        }
                                    >
                                        <option value="">همه استان ها</option>
                                        {provinces.map((province) => (
                                            <option
                                                key={province.id}
                                                value={province.id}
                                            >
                                                {province.title}
                                            </option>
                                        ))}
                                    </select>
                                </div> */}
                                <div className="form-group col-12 mb-2">
                                    <button
                                        type="submit"
                                        className="btn btn-lg btn-block text-uppercase text-2"
                                        style={{ backgroundColor: '#598bc4' }}
                                    >
                                        جستجو
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div className="row mt-3">
                    {cargos.data.map((cargo) => (
                        <CargoCart
                            key={cargo.ulid}
                            cargo={cargo}
                            footer={
                                <div className="card-footer0 p-0">
                                    <a
                                        href="tel:{{ $cargo->mobile }}"
                                        onClick={() => makeOrder(cargo.ulid)}
                                        className="btn btn-primary btn-lg btn-block text-uppercase text-white"
                                        style={{
                                            borderRadius: '10px',
                                            borderTopLeftRadius: '0px',
                                            borderTopRightRadius: '0px',
                                            backgroundColor: '#598bc4',
                                        }}
                                    >
                                        <i className="fas fa-phone-alt"></i>
                                        تماس با صاحب بار
                                    </a>
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
