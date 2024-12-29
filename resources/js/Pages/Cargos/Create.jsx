import Button from '@/Components/Button';
import SearchSelect from '@/Components/SearchSelect';
import TextAreaInput from '@/Components/TextAreaInput';
import TextInput from '@/Components/TextInput';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { router, usePage } from '@inertiajs/react';
import Box from '@mui/material/Box';
import Slider from '@mui/material/Slider';
import { useState } from 'react';

export default function RegisterForm({ cities, cargoTypes }) {
    const user = usePage().props.auth.user;
    const [form, setForm] = useState({
        mobile: user.mobile || '',
        carTypeId: '',
        cargoTypeId: '',
        originCityId: '',
        destinationCityId: '',
        weight: '',
        price: '',
        description: '',
    });

    const handleChange = (e) => {
        if (e.target) {
            // Handle regular input changes
            const { name, value } = e.target;
            setForm((prevForm) => ({ ...prevForm, [name]: value }));
        } else if (Array.isArray(e)) {
            // Handle Slider changes
            setForm((prevForm) => ({ ...prevForm, temperatureRange: e }));
        } else {
            // Handle react-select changes
            const { name, value } = e;
            setForm((prevForm) => ({ ...prevForm, [name]: value }));
        }
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
                                    onChange={(selected) =>
                                        handleChange({
                                            name: 'cargoTypeId',
                                            value: selected,
                                        })
                                    }
                                />
                            </div>

                            <div className="form-group row">
                                <SearchSelect
                                    label="شهر مبدا"
                                    id="originCityId"
                                    name="originCityId"
                                    options={cities}
                                    value={form.originCityId}
                                    onChange={(selected) =>
                                        handleChange({
                                            name: 'originCityId',
                                            value: selected,
                                        })
                                    }
                                />
                                <SearchSelect
                                    label="شهر مقصد"
                                    id="destinationCityId"
                                    name="destinationCityId"
                                    options={cities}
                                    value={form.destinationCityId}
                                    onChange={(selected) =>
                                        handleChange({
                                            name: 'destinationCityId',
                                            value: selected,
                                        })
                                    }
                                />
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
                                <div className="form-group col-12">
                                    <label htmlFor="temperature">
                                        محدوده دمایی
                                    </label>
                                    <Box className="col-12">
                                        <Slider
                                            getAriaLabel={() =>
                                                'Temperature'
                                            }
                                            orientation="horizontal"
                                            getAriaValueText={(value) =>
                                                `${value}°C`
                                            }
                                            defaultValue={[-5,5]}
                                            min={-25}
                                            max={25}
                                            value={form.temperatureRange}
                                            onChange={(_, value) =>
                                                handleChange(value)
                                            }
                                            valueLabelDisplay="auto"
                                            marks={[
                                                {
                                                    value: -25,
                                                    label: '25°C-',
                                                },
                                                {
                                                    value: 25,
                                                    label: '25°C',
                                                },
                                            ]}
                                        />
                                    </Box>
                                </div>
                                {/* <label
                                    htmlFor="range_05"
                                    className="col-sm-2 col-xs-12 control-label"
                                >
                                    <b>قدم</b>
                                    <span className="d-block font-13 text-muted clearfix">
                                        با استفاده از مرحله 250
                                    </span>
                                </label>
                                <div className="col-sm-10 col-xs-12">
                                    <input type="text" id="range_05" />
                                </div> */}
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
