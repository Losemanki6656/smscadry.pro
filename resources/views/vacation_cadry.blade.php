@extends('layouts.master')

@section('content')

    @if (\Session::has('msg'))
        @if (Session::get('msg') == 1)
            <div class="alert alert-success" id="success-alert">Succesfully!</div>
        @else
            <div class="alert alert-danger" id="success-alert2">Not Success!</div>
        @endif
    @endif

    <div class="row">
        <div class="col-8">
            <div class="card">
                <form action="{{route('vacation',['id' => $item->id])}}" method="get">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">{{ $item->fullname }}</h4>
                        <p class="card-title-desc mb-4">{{ $item->department->name ?? '' }}</p>
                        <table>
                            <thead>
                                <th width="170px">
                                    Lavozim uchun
                                </th>
                                <th width="170px">
                                    Staj uchun
                                </th>
                                <th width="170px">
                                    Ta'til periodi
                                </th>
                                <th width="170px">
                                    Ta'tilga chiqish sanasi
                                </th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="number" class="form-control" style="width: 140px;"
                                            value="{{ request('lavozim') ?? 0 }}" name="lavozim">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" style="width: 140px;"
                                            value="{{ request('staj') ?? 0 }}" name="staj">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" style="width: 140px;" name="period"
                                            value="{{ request('period') ?? now()->format('Y-m-d') }}"
                                            class="form-control">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" style="width: 140px;" name="sana"
                                            value="{{ request('sana') ?? now()->format('Y-m-d') }}"
                                            class="form-control">
                                    </td>
                                </tr>
                            </tbody>
                        </table> <br>
                        <div class="row">
                            <div class="col">
                                <div class="checkbox checkbox-primary d-inline mb-3">
                                    <input type="checkbox" name="yosh" id="checkbox1">
                                    <label for="checkbox1" class="cr">Yoshga to'lmaganlik</label>
                                </div> <br>
                                <div class="checkbox checkbox-primary d-inline mb-3">
                                    <input type="checkbox" name="nogiron" id="checkbox2">
                                    <label for="checkbox2" class="cr">2 - guruh nogironimi</label>
                                </div> <br>
                                <div class="checkbox checkbox-primary d-inline mb-3">
                                    <input type="checkbox" name="mehnat" id="checkbox3">
                                    <label for="checkbox3" class="cr">Og'ir mehnat sharoitidamik</label>
                                </div><br>
                                <div class="checkbox checkbox-primary d-inline mb-3">
                                    <input type="checkbox" name="nogiron_farzand" id="checkbox4">
                                    <label for="checkbox4" class="cr">Nogiron farzandlari bormi</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="checkbox checkbox-primary d-inline mb-3">
                                    <input type="checkbox" name="12yosh" id="checkbox5">
                                    <label for="checkbox5" class="cr">12 yoshga to'lmagan
                                        farzandlari bormi ?</label>
                                </div> <br>
                                <div class="checkbox checkbox-primary d-inline mb-3">
                                    <input type="checkbox" name="donor" id="checkbox6">
                                    <label for="checkbox6" class="cr">Donorlar ro'yxatiga a'zomi</label>
                                </div> <br>
                                <div class="checkbox checkbox-primary d-inline mb-3">
                                    <input type="checkbox" name="other_30" id="checkbox7">
                                    <label for="checkbox7" class="cr">Qo'shimcha 30 kun</label>
                                </div>
                            </div>
                        </div> <br>
                        <table>
                            <thead>
                                <th width="170px">
                                    Iqlim uchun
                                </th>
                                <th width="170px">
                                    Qolgan kunlari
                                </th>
                                <th>

                                </th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="number" value="{{ request('iqlinm') ?? 0 }}" style="width: 140px;"
                                            class="form-control" name="iqlinm">
                                    </td>
                                    <td>
                                        <input type="number" value="{{ request('qolgan_kun') ?? 0 }}"
                                            style="width: 140px;" class="form-control" name="qolgan_kun">
                                    </td>
                                    <td>
                                        <button class="btn btn-primary"> <i class="fas fa-angle-double-right"></i> View
                                            Result
                                            <i class="fas fa-angle-double-right"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>

            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h3>{{$day_vacation}} kun</h3>
                        <br>
                        <span class="ms-3"><i class="far fa-calendar-alt text-primary me-1"></i> 15/09/2021
                            dan</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <span class="ms-3"><i class="far fa-calendar-alt text-primary me-1"></i> 15/09/2021
                            gacha</span>
                    </div> <br> <br>
                    <h6 class="text-center"> Buyruqni yuborish</h6>
                    <select name="" id="sel_user" class="form-control" style="width: 100%">
                        <option value="">Username</option>
                    </select> <br> <br>
                    <a class="btn btn-primary" href="{{route('exportVacationToDoc')}}" style="width: 100%">
                        <i class="fab fa-telegram-plane"></i> Yuborish</a>
                </div>
            </div>
        </div>
    </div>
@endsection
