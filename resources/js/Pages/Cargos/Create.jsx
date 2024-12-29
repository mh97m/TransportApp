import Button from '@/Components/Button';
import SearchSelect from '@/Components/SearchSelect';
import SelectInput from '@/Components/SelectInput';
import TextAreaInput from '@/Components/TextAreaInput';
import TextInput from '@/Components/TextInput';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { router, usePage } from '@inertiajs/react';
import { useState } from 'react';

export default function RegisterForm({ cities, carTypes, cargoTypes }) {
    const user = usePage().props.auth.user;
    const [form, setForm] = useState({
        mobile: user.mobile || '',
        cargoTypeId: '',
        originCityId: '',
        destinationCityId: '',
        carTypeId: '',
        loaderTypeId: '',
        weight: '',
        price: '',
        description: '',
    });

    const [loaderTypes, setLoaderTypes] = useState([]);

    const handleChange = (e) => {
        setForm({ ...form, [e.target.name]: e.target.value });
    };


    const handleSubmit = (e) => {
        e.preventDefault();
        router.post(route('cargos.store'), form);
    };

    return (
        <AuthenticatedLayout>
            <div className="row">
                <div className="col-12">
                    <div className="card-box">
                        <h3 className="mb-4">اعلام بار</h3>
                        <form onSubmit={handleSubmit}>
                            <div className="form-group row">
                                <TextInput
                                    label="شماره موبایل"
                                    id="mobile"
                                    name="mobile"
                                    value={form.mobile}
                                    onChange={handleChange}
                                />
                                <SearchSelect
                                    label="نوع بار"
                                    id="cargoTypeId"
                                    name="cargoTypeId"
                                    options={cargoTypes}
                                    value={form.cargoTypeId}
                                    onChange={handleChange}
                                />
                            </div>

                            <div className="form-group row">
                                <SelectInput
                                    label="شهر مبدا"
                                    id="originCityId"
                                    name="originCityId"
                                    options={cities}
                                    value={form.originCityId}
                                    onChange={handleChange}
                                />
                                <SelectInput
                                    label="شهر مقصد"
                                    id="destinationCityId"
                                    name="destinationCityId"
                                    options={cities}
                                    value={form.destinationCityId}
                                    onChange={handleChange}
                                />
                            </div>

                            <div className="form-group row">
                                <SelectInput
                                    label="نوع ماشین"
                                    id="carTypeId"
                                    name="carTypeId"
                                    options={carTypes}
                                    value={form.carTypeId}
                                    onChange={(e) => {
                                        handleChange(e);
                                        // loadLoaderTypes(e.target.value);
                                    }}
                                />
                                {/* <SelectInput
                                    label="نوع بارگیر"
                                    id="loaderTypeId"
                                    name="loaderTypeId"
                                    options={loaderTypes}
                                    value={form.loaderTypeId}
                                    onChange={handleChange}
                                /> */}
                            </div>

                            <div className="form-group row">
                                <TextInput
                                    label="وزن (تن)"
                                    type="number"
                                    id="weight"
                                    name="weight"
                                    value={form.weight}
                                    onChange={handleChange}
                                />
                                <TextInput
                                    label="مبلغ"
                                    type="number"
                                    id="price"
                                    name="price"
                                    value={form.price}
                                    onChange={handleChange}
                                />
                            </div>

                            <div className="form-group row">
                                <TextAreaInput
                                    label="توضیحات"
                                    id="description"
                                    name="description"
                                    value={form.description}
                                    onChange={handleChange}
                                />
                            </div>

                            <Button label="ذخیره" type="submit" />
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
