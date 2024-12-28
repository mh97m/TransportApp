import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function Orders({  }) {
    console.log(1111)
    return (
        <AuthenticatedLayout>
            <div className="container-fluid">
                aaaaaaaa
                {/* <div className="row mt-3">
                {orders.data.map((order) => (
                    <div
                        className="col-lg-4 col-md-6 col-sm-12 mb-3"
                        key={order.id}
                    >
                        <div
                            className="card"
                            style={{
                                borderRadius: '10px',
                                boxShadow: '0px 0px 7px rgba(0, 0, 0, 0.342)',
                            }}
                        >
                            <div className="card-body text-center">
                                <div className="d-flex flex-column align-items-center position-relative mb-3">
                                    <div className="text-center">
                                        <div className="small text-muted my-1">
                                            {order.cargo.distance} کیلومتر
                                        </div>
                                    </div>

                                    <div
                                        className="w-100 position-relative mb-3"
                                        style={{
                                            height: '14px',
                                            width: '70% !important',
                                        }}
                                    >
                                        <div className="position-absolute w-100 d-flex align-items-center">
                                            <svg
                                                width="30"
                                                height="30"
                                                viewBox="0 0 16 16"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <g id="vuesax/bold/gps"></g>
                                            </svg>
                                            <svg
                                                width="100%"
                                                height="50"
                                                viewBox="0 0 250 50"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
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
                                                <path
                                                    d="M 10 22 L 10 28 L 0 25 Z"
                                                    fill="white"
                                                />
                                            </svg>
                                            <svg
                                                width="30"
                                                height="30"
                                                viewBox="0 0 16 16"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <g id="Bold/location">
                                                    <path
                                                        id="Vector"
                                                        d="M13.7467 5.63341C13.0467 2.55341 10.3601 1.16675 8.00006 1.16675C8.00006 1.16675 8.00006 1.16675 7.9934 1.16675C5.64006 1.16675 2.94673 2.54675 2.24673 5.62675C1.46673 9.06675 3.5734 11.9801 5.48006 13.8134C6.18673 14.4934 7.0934 14.8334 8.00006 14.8334C8.90673 14.8334 9.8134 14.4934 10.5134 13.8134C12.4201 11.9801 14.5267 9.07341 13.7467 5.63341ZM8.00006 8.97341C6.84006 8.97341 5.90006 8.03341 5.90006 6.87341C5.90006 5.71341 6.84006 4.77341 8.00006 4.77341C9.16006 4.77341 10.1001 5.71341 10.1001 6.87341C10.1001 8.03341 9.16006 8.97341 8.00006 8.97341Z"
                                                        fill="#484B52"
                                                    />
                                                </g>
                                            </svg>
                                        </div>
                                    </div>

                                    <div className="d-flex justify-content-between w-100 h4">
                                        <div
                                            className="text-center"
                                            style={{ marginRight: '65px' }}
                                        >
                                            <i className="fas fa-map-marker-alt fa-lg text-danger mb-1"></i>
                                            <div className="small text-muted">
                                                مبدا
                                            </div>
                                        </div>
                                        <div
                                            className="text-center"
                                            style={{ marginLeft: '65px' }}
                                        >
                                            <i className="fas fa-map-signs fa-lg text-success mb-1"></i>
                                            <div className="small text-muted">
                                                مقصد
                                            </div>
                                        </div>
                                    </div>

                                    <div className="row col-12 d-flex justify-content-between w-100 h4">
                                        <div className="col-4 text-center">
                                            <h5 className="font-weight-bold mb-0">
                                                {
                                                    order.cargo.originProvince
                                                        .title
                                                }
                                            </h5>
                                            <small className="text-muted">
                                                {order.cargo.originCity.title}
                                            </small>
                                        </div>
                                        <div className="col-4 text-center">
                                            <h5 className="font-weight-bold mb-0">
                                                {
                                                    order.cargo
                                                        .destinationProvince
                                                        .title
                                                }
                                            </h5>
                                            <small className="text-muted">
                                                {
                                                    order.cargo.destinationCity
                                                        .title
                                                }
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div className="d-flex justify-content-center align-items-center my-4">
                                    <div
                                        className="border-top border-primary"
                                        style={{ width: '100%' }}
                                    ></div>
                                </div>

                                <div className="text-muted mt-3">
                                    <p className="h4 d-flex justify-content-start align-items-center mb-2 pt-2">
                                        <svg
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            className="mr-2"
                                        >
                                            <g id="group">
                                                <path
                                                    id="Vector"
                                                    d="M12 2C10.9 2 10 2.9 10 4V14C8.34 14 7 15.34 7 17C7 18.66 8.34 20 10 20H14C15.66 20 17 18.66 17 17C17 15.34 15.66 14 14 14V4C14 2.9 13.1 2 12 2Z"
                                                    stroke="#598bc4cf"
                                                    strokeWidth="1.5"
                                                    strokeLinecap="round"
                                                    strokeLinejoin="round"
                                                />
                                                <path
                                                    id="Vector_2"
                                                    d="M12 6V14"
                                                    stroke="#598bc4cf"
                                                    strokeWidth="1.5"
                                                    strokeLinecap="round"
                                                    strokeLinejoin="round"
                                                />
                                                <path
                                                    id="Vector_3"
                                                    d="M12 17C11.4477 17 11 16.5523 11 16C11 15.4477 11.4477 15 12 15C12.5523 15 13 15.4477 13 16C13 16.5523 12.5523 17 12 17Z"
                                                    fill="#598bc4cf"
                                                />
                                            </g>
                                        </svg>
                                        {order.cargo.weight} تن
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                ))}
            </div>

            <Pagination links={cargos.links} /> */}
            </div>
        </AuthenticatedLayout>
    );
}
