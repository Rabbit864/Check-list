@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Список чек-листов
                    <button class="btn btn-primary offset-md-7" data-toggle="modal" data-target="#create-check-list-modal">Добавить чек лист</button>
                </div>

                <div class="card-body">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                <th scope="col">№</th>
                                <th scope="col">Название</th>
                                <th>Описание</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($checkLists as $checkList)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td class="name">{{$checkList->name}}</td>
                                    <td class="text-break description">{{$checkList->description}}</td>
                                    <td> <a href="{{ route('detailing',$checkList->id) }}" class="btn btn-primary">Страница детализации</a></td>
                                    <td> <button class="btn btn-primary edit" data="{{$checkList->id}}">Редактировать</button></td>
                                    <td>
                                        <form action="{{ route('destroy-check-list', $checkList->id)}}" id="form-destroy-{{$checkList->id}}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger" form="form-destroy-{{$checkList->id}}">
                                                Удалить
                                            </button>
                                        </form>
                                    </td>
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
    <div class="modal" tabindex="-1" role="edit-check-list" id="edit-check-list-modal">
        <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Создание чек листа</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                          <label for="nameCheckList">Название</label>
                          <input type="text"  name="name" class="form-control" id="updateNameCheckList" placeholder="Введите название">
                      </div>
                      <div class="form-group">
                          <label for="descriptionCheckList">Описание</label>
                          <textarea class="form-control" id="updateDescriptionCheckList" name="description"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Обновить</button>
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
            $('.edit').on('click', function(){
                let id = $(this).attr('data');
                let name = $(this).parent().parent().find('.name').text();
                let description = $(this).parent().parent().find('.description').text();
                $('#edit-check-list-modal form').attr('action', `/updateCheckList/${id}`);
                $('#edit-check-list-modal #updateNameCheckList').val(name);
                $('#edit-check-list-modal #updateDescriptionCheckList').val(description);
                $('#edit-check-list-modal').modal('show');
            });
        });
    </script>
@endsection
