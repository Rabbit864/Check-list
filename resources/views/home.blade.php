@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Список чек-листов
                    <button class="btn btn-primary offset-md-5" data-toggle="modal" data-target="#create-check-list-modal">Добавить чек лист</button>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">№</th>
                                <th scope="col">Название</th>
                                <th scope="col">Описание</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($checkLists as $checkList)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td >{{$checkList->name}}</td>
                                    <td>{{$checkList->description}}</td>
                                    <td> <a href="{{ route('detailing',$checkList->id) }}" class="btn btn-primary">Страница детализации</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="create-check-list" id="create-check-list-modal">
      <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Создание чек листа</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('create-check-list')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nameCheckList">Название</label>
                        <input type="text"  name="name" class="form-control" id="nameCheckList" placeholder="Введите название">
                    </div>
                    <div class="form-group">
                        <label for="descriptionCheckList">Описание</label>
                        <textarea class="form-control" id="descriptionCheckList" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $( document ).ready(function() {

        });
    </script>
@endsection
