@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">{{ $checkList->name }}</h1>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#create-paragraph-modal">Добавить пункт</button>
                    <div class="accordeon">
                        @foreach ($checkList->paragraphs as $paragraph)
                            <div class="card accordeon-item mt-3">
                                <div class="card-header d-flex justify-content-between accordeon-header">
                                    <div class="form-check">
                                        <input class="form-check-input accordeon-status" type="checkbox" id="checkbox-{{$paragraph->id}}" style="transform:scale(1.7);" @if($paragraph->status === 1) checked @endif>
                                        <label class="form-check-label" for="checkbox-{{$paragraph->id}}">
                                            {{$paragraph->name}}
                                        </label>
                                      </div>

                                    <button class="btn btn-primary accordeon-button">+</button>
                                </div>
                                <div class="card-body accordeon-text">
                                    <p>{{$paragraph->description}}</p>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#create-sub-paragraph-modal">Добавить подпункт</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="create-paragraph-modal" id="create-paragraph-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Создание пункта</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('create-paragraph', $checkList->id )}}" method="POST">
                      @csrf
                      <div class="form-group">
                          <label for="nameParagraph">Название</label>
                          <input type="text"  name="name" class="form-control" id="nameParagraph" placeholder="Введите название">
                      </div>
                      <div class="form-group">
                          <label for="descriptionParagraph">Описание</label>
                          <textarea class="form-control" id="descriptionParagraph" name="description"></textarea>
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
            $('.accordeon-text').hide();
            $('.accordeon .accordeon-button').on('click', function(){
                $(this).parent().next().slideToggle(150);
            });
            $('.accordeon-status').on('click', function(){
                let id = $(this).attr('id');
                let status = $(this).prop('checked');
                id = id.replace('checkbox-','');
                let url = '/updateStatus/' + id;
                let formData = new FormData();
                status = status ? 1 : 0;
                formData.append('status',status);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'POST',
                    url: url,
                    processData: false,
                    contentType: false,
                    data: formData,
                    success:function(data){
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endsection
