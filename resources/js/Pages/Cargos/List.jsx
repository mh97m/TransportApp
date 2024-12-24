import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { router } from '@inertiajs/react';
import { useState } from 'react';

export default function List({ queryParams, cargos, provinces }) {
    const [queryParamsState, setQueryParamsState] = useState(queryParams || {});

    const setQueryParams = (name, value) => {
        setQueryParamsState((prev) => {
            const updatedParams = { ...prev, [name]: value };
            if (!value) {
                delete updatedParams[name];
            }
            return updatedParams;
        });
    };

    const search = (name, value) => {
        // router.reload({ only: ['users'], })

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

    // const [provinces, setProvinces] = useState([]);

    const [originProvince, setOriginProvince] = useState('');
    const [destinationProvince, setDestinationProvince] = useState('');

    // useEffect(() => {
    //     // router.get(
    //     //     route('get-provinces'),
    //     //     {},
    //     //     {
    //     //         preserveState: true, // Keeps the current state while fetching
    //     //         onSuccess: (page) => {
    //     //             setProvinces(page.props.data || []); // Assuming provinces are in `data`
    //     //         },
    //     //         onError: (errors) => {
    //     //             console.error('Error fetching provinces:', errors);
    //     //         },
    //     //     }
    //     // );
    // }, [
    //     // provinces,
    // ]);

    // const makeOrder = (cargoId) => {
    //     axios
    //         .post(`/api/orders`, { cargo_id: cargoId })
    //         .then((response) => {
    //             alert('Order created successfully');
    //             // fetchCargos(); // Refresh the list
    //         })
    //         .catch((error) => console.error('Error creating order:', error));
    // };

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
                                <div className="form-group col-6 mb-2">
                                    <label htmlFor="originProvince">استان مبدا</label>
                                    <select
                                        className="form-control text-uppercase text-2"
                                        id='originProvince'
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
                                    <label htmlFor="originProvince">استان مقصد</label>
                                    <select
                                        className="form-control text-uppercase text-2"
                                        id='originProvince'
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
                                </div>
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
                    {cargos.map((cargo) => (
                        <div
                            key={cargo.id}
                            className="col-lg-4 col-md-6 col-sm-12 mb-3"
                        >
                            <div
                                className="card"
                                style={{
                                    borderRadius: '10px',
                                    boxShadow:
                                        '0px 0px 7px rgba(0, 0, 0, 0.342)',
                                }}
                            >
                                <div className="card-body text-center">
                                    <div className="d-flex flex-column align-items-center position-relative mb-3">
                                        <div className="text-center">
                                            <div
                                                className="small text-muted text-3 my-1"
                                                style={{ fontSize: '16px' }}
                                            >
                                                {cargo.distance} کیلومتر
                                            </div>
                                        </div>

                                        <div
                                            className="w-100 position-relative mb-3"
                                            style={{
                                                height: '14px',
                                                width: '70% !important',
                                            }}
                                        >
                                            <div className="position-absolute w-100 d-flex align-items-center justify-content-center">
                                                <i
                                                    className="fas fa-map-marker-alt text-danger mb-1 mr-1"
                                                    style={{ fontSize: '32px' }}
                                                ></i>

                                                <svg
                                                    // width="100%"
                                                    height="50"
                                                    viewBox="0 0 100 50"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    style={{
                                                        borderStartStartRadius:
                                                            '30px',
                                                        borderEndStartRadius:
                                                            '30px',
                                                        marginLeft: '5px',
                                                    }}
                                                >
                                                    <rect
                                                        x="0"
                                                        y="15"
                                                        width="100%"
                                                        height="20"
                                                        fill="#4e4e4ec9"
                                                    />

                                                    <line
                                                        x1="0"
                                                        y1="25"
                                                        x2="10"
                                                        y2="25"
                                                        stroke="white"
                                                        strokeWidth="2"
                                                    />
                                                    <line
                                                        x1="20"
                                                        y1="25"
                                                        x2="30"
                                                        y2="25"
                                                        stroke="white"
                                                        strokeWidth="2"
                                                    />
                                                    <line
                                                        x1="40"
                                                        y1="25"
                                                        x2="50"
                                                        y2="25"
                                                        stroke="white"
                                                        strokeWidth="2"
                                                    />
                                                    <line
                                                        x1="60"
                                                        y1="25"
                                                        x2="70"
                                                        y2="25"
                                                        stroke="white"
                                                        strokeWidth="2"
                                                    />
                                                    <line
                                                        x1="80"
                                                        y1="25"
                                                        x2="90"
                                                        y2="25"
                                                        stroke="white"
                                                        strokeWidth="2"
                                                    />
                                                    <line
                                                        x1="230"
                                                        y1="25"
                                                        x2="240"
                                                        y2="25"
                                                        stroke="white"
                                                        strokeWidth="2"
                                                    />
                                                </svg>

                                                <i
                                                    className="fas fa-car-side text-secondary mb-1"
                                                    style={{
                                                        fontSize: '24px',
                                                        transform: 'scaleX(-1)',
                                                    }}
                                                ></i>

                                                <svg
                                                    height="50"
                                                    viewBox="0 0 100 50"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    style={{
                                                        borderStartEndRadius:
                                                            '30px',
                                                        borderEndEndRadius:
                                                            '30px',
                                                        marginRight: '5px',
                                                    }}
                                                >
                                                    <rect
                                                        x="0"
                                                        y="15"
                                                        width="100%"
                                                        height="20"
                                                        fill="#4e4e4ec9"
                                                    />

                                                    <line
                                                        x1="10"
                                                        y1="25"
                                                        x2="20"
                                                        y2="25"
                                                        stroke="white"
                                                        strokeWidth="2"
                                                    />
                                                    <line
                                                        x1="30"
                                                        y1="25"
                                                        x2="40"
                                                        y2="25"
                                                        stroke="white"
                                                        strokeWidth="2"
                                                    />
                                                    <line
                                                        x1="50"
                                                        y1="25"
                                                        x2="60"
                                                        y2="25"
                                                        stroke="white"
                                                        strokeWidth="2"
                                                    />
                                                    <line
                                                        x1="70"
                                                        y1="25"
                                                        x2="80"
                                                        y2="25"
                                                        stroke="white"
                                                        strokeWidth="2"
                                                    />
                                                    <line
                                                        x1="90"
                                                        y1="25"
                                                        x2="100"
                                                        y2="25"
                                                        stroke="white"
                                                        strokeWidth="2"
                                                    />

                                                    <path
                                                        d="M 10 22 L 10 28 L 0 25 Z"
                                                        fill="white"
                                                    />
                                                </svg>

                                                <i
                                                    className="fas fa-map-pin text-success mb-1 ml-1 mr-1"
                                                    style={{ fontSize: '32px' }}
                                                ></i>
                                            </div>
                                        </div>

                                        <div className="row col-12 d-flex justify-content-between w-100 h4">
                                            <div className="col-4 text-center">
                                                <h4 className="font-weight-bold mb-1">
                                                    {
                                                        cargo.origin_province
                                                            ?.title
                                                    }
                                                </h4>
                                                <small
                                                    className="text-muted"
                                                    style={{ fontSize: '14px' }}
                                                >
                                                    {cargo.origin_city?.title}
                                                </small>
                                            </div>

                                            <div className="col-4 text-center">
                                                <h4 className="font-weight-bold mb-1">
                                                    {
                                                        cargo
                                                            .destination_province
                                                            ?.title
                                                    }
                                                </h4>
                                                <small
                                                    className="text-muted"
                                                    style={{ fontSize: '14px' }}
                                                >
                                                    {
                                                        cargo.destination_city
                                                            ?.title
                                                    }
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="text-muted mt-3">
                                        <p className="h4 d-flex justify-content-start align-items-center mb-2 pt-2">
                                            <i
                                                className="fas fa-weight text-secondary mb-1 mr-2"
                                                style={{ fontSize: '24px' }}
                                            ></i>
                                            {cargo.weight} تن
                                        </p>
                                        <p className="h4 d-flex justify-content-start align-items-center mb-2 pt-2">
                                            <i
                                                className="fas fa-car-side text-secondary mb-1 mr-2"
                                                style={{
                                                    fontSize: '24px',
                                                    transform: 'scaleX(-1)',
                                                }}
                                            ></i>
                                            {cargo.car_type?.title} یخچالی
                                        </p>
                                        <p className="h4 d-flex justify-content-start align-items-center mb-2 pt-2">
                                            <i
                                                className="far fa-comment-alt text-secondary mb-1 mr-2"
                                                style={{ fontSize: '24px' }}
                                            ></i>
                                            {cargo.description}
                                        </p>
                                    </div>

                                    <div className="row mt-4 text-center">
                                        <div className="col-12">
                                            <h4
                                                className="text-black"
                                                style={{ fontSize: '22px' }}
                                            >
                                                <i className="fas fa-coins text-success fa-lg h4"></i>{' '}
                                                {cargo.price.toLocaleString()}{' '}
                                                تومان
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div className="card-footer0 p-0">
                                    <button
                                        onClick={() => makeOrder(cargo.id)}
                                        className="btn btn-primary btn-lg btn-block text-uppercase text-white"
                                        style={{
                                            borderRadius: '10px',
                                            borderTopLeftRadius: '0px',
                                            borderTopRightRadius: '0px',
                                            backgroundColor: '#598bc4',
                                        }}
                                    >
                                        <i className="fas fa-phone-alt"></i>{' '}
                                        تماس با صاحب بار
                                    </button>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
