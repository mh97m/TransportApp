import React, { useEffect, useState } from 'react';
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function List ({
    provinces,
    queryParams,
    cargos,
}) {
    queryParams = queryParams || {};
    const searchFieldChanged = (name, value) => {
      if (value) {
        queryParams[name] = value;
      } else {
        delete queryParams[name];
      }
  
      router.get(route("project.index"), queryParams);
    };
  
    const onKeyPress = (name, e) => {
      if (e.key !== "Enter") return;
  
      searchFieldChanged(name, e.target.value);
    };
  
    const sortChanged = (name) => {
      if (name === queryParams.sort_field) {
        if (queryParams.sort_direction === "asc") {
          queryParams.sort_direction = "desc";
        } else {
          queryParams.sort_direction = "asc";
        }
      } else {
        queryParams.sort_field = name;
        queryParams.sort_direction = "asc";
      }
      router.get(route("project.index"), queryParams);
    };
  
    const deleteProject = (project) => {
      if (!window.confirm("Are you sure you want to delete the project?")) {
        return;
      }
      router.delete(route("project.destroy", project.id));
    };
  
    console.log(cargos)
    const [originProvinces, setOriginProvinces] = useState(provinces);
    const [originProvince, setOriginProvince] = useState('');

    const [destinationProvinces, setDestinationProvinces] = useState(provinces);
    const [destinationProvince, setDestinationProvince] = useState('');

    // const [originCities, setOriginCities] = useState([]);
    // const [originCity, setOriginCity] = useState('');
    // const [destinationCities, setDestinationCities] = useState([]);
    // const [destinationCity, setDestinationCity] = useState('');

    // const [cargos, setCargos] = useState([]);
    // const [currentPage, setCurrentPage] = useState(1);

    const fetchCargos = () => {
        // const params = {
        //     originProvince,
        //     originCity,
        //     destinationProvince,
        //     destinationCity,
        //     page: currentPage,
        // };

        // axios.get('/api/cargos', { params })
        //     .then(response => setCargos(response.data.data))
        //     .catch(error => console.error('Error fetching cargos:', error));
    };

    // useEffect(() => {
    //     fetchCargos();
    // }, [originProvince, originCity, destinationProvince, destinationCity, currentPage]);

    const makeOrder = (cargoId) => {
        axios.post(`/api/orders`, { cargo_id: cargoId })
            .then(response => {
                alert('Order created successfully');
                // fetchCargos(); // Refresh the list
            })
            .catch(error => console.error('Error creating order:', error));
    };

    return (
        <AuthenticatedLayout>
            <div className="container-fluid">
                <div className="row mt-4 mb-2">
                    <div className="col">
                        <form onSubmit={(e) => { e.preventDefault(); fetchCargos(); }}>
                            <div className="form-row">
                                <div className="form-group col-6 mb-2">
                                    <select
                                        className="form-control text-uppercase text-2"
                                        value={originProvince}
                                        onChange={(e) => setOriginProvince(e.target.value)}
                                    >
                                        <option value="">استان مبدا</option>
                                        {originProvinces.map(province => (
                                            <option key={province.id} value={province.id}>{province.title}</option>
                                        ))}
                                    </select>
                                </div>
                                <div className="form-group col-6 mb-2">
                                    <select
                                        className="form-control text-uppercase text-2"
                                        value={destinationProvince}
                                        onChange={(e) => setDestinationProvince(e.target.value)}
                                    >
                                        <option value="">استان مقصد</option>
                                        {destinationProvinces.map(province => (
                                            <option key={province.id} value={province.id}>{province.title}</option>
                                        ))}
                                    </select>
                                </div>
                                <div className="form-group col-12 mb-2">
                                    <button type="submit" className="btn btn-lg btn-block text-uppercase text-2" style={{ backgroundColor: '#598bc4' }}>
                                        جستجو
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div className="row mt-3">
                    {/* {cargos.map(cargo => (
                        <div key={cargo.id} className="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <div className="card" style={{ borderRadius: '10px', boxShadow: '0px 0px 7px rgba(0, 0, 0, 0.342)' }}>
                                <div className="card-body text-center">
                                    <div className="d-flex flex-column align-items-center position-relative mb-3">
                                        <div className="text-center">
                                            <div className="small text-muted my-1">{cargo.distance} کیلومتر</div>
                                        </div>
                                        <div className="d-flex justify-content-between w-100 h4">
                                            <div className="text-center" style={{ marginRight: '65px' }}>
                                                <i className="fas fa-map-marker-alt fa-lg text-danger mb-1"></i>
                                                <div className="small text-muted">مبدا</div>
                                            </div>
                                            <div className="text-center" style={{ marginLeft: '65px' }}>
                                                <i className="fas fa-map-signs fa-lg text-success mb-1"></i>
                                                <div className="small text-muted">مقصد</div>
                                            </div>
                                        </div>
                                        <div className="row col-12 d-flex justify-content-between w-100 h4">
                                            <div className="col-4 text-center">
                                                <h5 className="font-weight-bold mb-0">{cargo.originProvince.title}</h5>
                                                <small className="text-muted">{cargo.originCity.title}</small>
                                            </div>
                                            <div className="col-4 text-center">
                                                <h5 className="font-weight-bold mb-0">{cargo.destinationProvince.title}</h5>
                                                <small className="text-muted">{cargo.destinationCity.title}</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="text-muted mt-3">
                                        <p className="mb-2 pt-2 h4 d-flex justify-content-start align-items-center">
                                            {cargo.weight} تن
                                        </p>
                                        <p className="mb-2 pt-2 h4 d-flex justify-content-start align-items-center">
                                            {cargo.carType.title} {cargo.loaderType.title}
                                        </p>
                                        <p className="mb-2 pt-2 h4 d-flex justify-content-start align-items-center text-left">
                                            {cargo.description}
                                        </p>
                                    </div>

                                    <div className="row mt-4 text-center">
                                        <div className="col-12">
                                            <h4 className="text-black" style={{ fontSize: '22px' }}>
                                                <i className="fas fa-coins text-success fa-lg h4"></i> {cargo.price.toLocaleString()} تومان
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div className="card-footer0 p-0">
                                    <button
                                        onClick={() => makeOrder(cargo.id)}
                                        className="btn btn-primary btn-lg btn-block text-white text-uppercase"
                                        style={{ borderRadius: '10px', borderTopLeftRadius: '0px', borderTopRightRadius: '0px', backgroundColor: '#598bc4' }}
                                    >
                                        <i className="fas fa-phone-alt"></i> تماس با صاحب بار
                                    </button>
                                </div>
                            </div>
                        </div>
                    ))} */}
                </div>
            </div>
        </AuthenticatedLayout>
    );
};
