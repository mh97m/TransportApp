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
        temperatureRange: [-5, 5], // Initialize temperature range state
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

    const handleSliderChange = (_, newValue) => {
        setForm((prevForm) => ({ ...prevForm, temperatureRange: newValue }));
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
                                            min={-25}
                                            max={25}
                                            value={form.temperatureRange}
                                            onChange={handleSliderChange}
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
