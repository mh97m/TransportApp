import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import TextInput from '@/Components/TextInput';
import Button from '@/Components/Button';
import SearchSelect from '@/Components/SearchSelect';
import { useForm } from '@inertiajs/react';
import { usePage } from '@inertiajs/react';
import { useEffect } from 'react';

export default function Edit({ carTypes, userDetails }) {
    const getOptionByValue = (options, value) => {
        return options.find((option) => option.value === value) || null;
    };

    const user = usePage().props.auth.user;

    const { data, setData, patch, processing, errors } = useForm({
        name: user.name || '',
        mobile: user.mobile || '',
        nationalCode: user.national_code || '',
        carTypeId: userDetails?.car_type_id || '',
        plaque: userDetails?.plaque || '',
        license: userDetails?.license || '',
    });

    const handleChange = (e) => {
        const { name, value } = e.target;
        setData(name, value);
    };

    const handleSelectChange = (name, selectedOption) => {
        setData(name, selectedOption ? selectedOption.value : '');
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        patch(route('profile.update')); // Use Inertia's patch method for updating data
    };

    return (
        <AuthenticatedLayout>
            <div className="row">
                <div className="col-12">
                    <div className="card-box">
                        <h3 className="mb-4">ویرایش پروفایل</h3>
                        <form onSubmit={handleSubmit}>
                            <div className="form-group row">
                                <TextInput
                                    label="نام"
                                    id="name"
                                    name="name"
                                    value={data.name}
                                    onChange={handleChange}
                                    error={errors.name}
                                />
                                <TextInput
                                    label="شماره موبایل"
                                    id="mobile"
                                    name="mobile"
                                    value={data.mobile}
                                    onChange={handleChange}
                                    error={errors.mobile}
                                />
                                <TextInput
                                    label="کد ملی"
                                    id="nationalCode"
                                    name="nationalCode"
                                    value={data.nationalCode}
                                    onChange={handleChange}
                                    error={errors.nationalCode}
                                />
                            </div>

                            {userDetails && (
                                <>
                                    <div className="form-group row">
                                        <SearchSelect
                                            label="نوع وسیله"
                                            id="carTypeId"
                                            name="carTypeId"
                                            options={carTypes}
                                            value={getOptionByValue(carTypes, data.carTypeId)}
                                            onChange={(selected) =>
                                                handleSelectChange('carTypeId', selected)
                                            }
                                            error={errors.carTypeId}
                                        />
                                        <TextInput
                                            label="پلاک"
                                            id="plaque"
                                            name="plaque"
                                            value={data.plaque}
                                            onChange={handleChange}
                                            error={errors.plaque}
                                        />
                                    </div>
                                    <div className="form-group row">
                                        <TextInput
                                            label="گواهینامه"
                                            id="license"
                                            name="license"
                                            value={data.license}
                                            onChange={handleChange}
                                            error={errors.license}
                                        />
                                    </div>
                                </>
                            )}

                            <Button label="ذخیره" type="submit" disabled={processing} />
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
