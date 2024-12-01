<?php

use App\Models\City;
use App\Models\Province;
use Livewire\Volt\Component;

new class extends Component
{
    public $provinces;
    public $cities;
    public $cargos;

    public function mount($cargos)
    {
        $this->cargos = $cargos;

        $this->provinces = Province::query()
            ->orderBy('name', 'asc')
            ->get();
        $this->cities = City::query()
            ->orderBy('name', 'asc')
            ->get();
    }
}; ?>

<div class="row mt-4 mb-2 mb-lg-0">
    <div class="col">
        <form >
            <div class="form-row">
                <div class="form-group col-lg-2 mb-0">
                    <div class="form-control-custom mb-3">
                        <select class="form-control text-uppercase text-2" name="propertiesPropertyType" data-msg-required="وارد کردن این قسمت الزامی است." id="propertiesPropertyType2" required="">
                            <option value="">استان مبدا</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-lg-2 mb-0">
                    <div class="form-control-custom mb-3">
                        <select class="form-control text-uppercase text-2" name="propertiesPropertyType" data-msg-required="وارد کردن این قسمت الزامی است." id="propertiesPropertyType2" required="">
                            <option value="">شهر مبدا</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-lg-2 mb-0">
                    <div class="form-control-custom mb-3">
                        <select class="form-control text-uppercase text-2" name="propertiesPropertyType" data-msg-required="وارد کردن این قسمت الزامی است." id="propertiesPropertyType2" required="">
                            <option value="">استان مقصد</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-lg-2 mb-0">
                    <div class="form-control-custom mb-3">
                        <select class="form-control text-uppercase text-2" name="propertiesPropertyType" data-msg-required="وارد کردن این قسمت الزامی است." id="propertiesPropertyType2" required="">
                            <option value="">شهر مقصد</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-lg-2 mb-0">
                    <input type="submit" value="جستجو" class="btn btn-secondary btn-lg btn-block text-uppercase text-2">
                </div>
            </div>
        </form>
    </div>
</div>