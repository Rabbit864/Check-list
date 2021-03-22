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
                            <div class="card accordeon-item mt-3" id="card-{{$paragraph->id}}">
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
                                    <div class="sub-paragraphs mt-2 mb-2">
                                        @foreach ($paragraph->subParagraphs as $subParagraph)
                                            <div class="form-check subParagraph-{{$subParagraph->id}}">
                                                <input class="form-check-input accordeon-sub-status" type="checkbox" name="sub-status" style="transform:scale(1.7);" id="sub-checkbox-{{$subParagraph->id}}" @if($subParagraph->status === 1) checked @endif>
                                                <label class="form-check-label" for="sub-checkbox-{{$subParagraph->id}}">
                                                    {{$subParagraph->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="btn btn-primary" data-toggle="modal" onclick="addSubParagraph({{$paragraph->id}})">Добавить подпункт</button>
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
    <div class="modal" tabindex="-1" role="create-paragraph-modal" id="create-sub-paragraph-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Создание пункта</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="create-sub-paragraph-form">
                      @csrf
                      <input type="hidden" name="paragraph_id" id="paragraph_id">
                      <div class="form-group">
                          <label for="nameSubParagraph">Название</label>
                          <input type="text"  name="name" class="form-control" id="nameSubParagraph" placeholder="Введите название">
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
                    }
                });
            });
            updateSubStatus();
            $('.create-sub-paragraph-form').submit(function(e){
                e.preventDefault();
                let name = $('#create-sub-paragraph-modal #nameSubParagraph').val();
                let paragraph_id = $('#create-sub-paragraph-modal #paragraph_id').val();
                let formData = new FormData();
                formData.append('name', name);
                formData.append('paragraph_id', paragraph_id);
                $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: 'POST',
                        url: '/createSubParagraph',
                        processData: false,
                        contentType: false,
                        data: formData,
                        success:function(data){
                            let subParagraph = `<div class="form-check subParagraph-${data.id}">
                                <input class="form-check-input accordeon-sub-status" type="checkbox" name="sub-status" style="transform:scale(1.7);" id="sub-checkbox-${data.id}">
                                <label class="form-check-label">
                                    ${data.name}
                                </label>
                                </div>`;
                            $('#card-' + paragraph_id + " .sub-paragraphs").append(subParagraph);
                            updateSubStatus();
                            $('.create-sub-paragraph-form').trigger('reset');
                            $('#create-sub-paragraph-modal').modal('hide');
                        }
                });
            });
        });

        function addSubParagraph(idParagraph){
            $('#create-sub-paragraph-modal #paragraph_id').val(idParagraph);
            $('#create-sub-paragraph-modal').modal('show');
        }
        function updateSubStatus(){
            $('.accordeon-sub-status').on('click', function(){
                let id = $(this).attr('id');
                let status = $(this).prop('checked');
                id = id.replace('sub-checkbox-','');
                let formData = new FormData();
                status = status ? 1 : 0;
                formData.append('status',status);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'POST',
                    url: '/updateSubStatus/' + id,
                    processData: false,
                    contentType: false,
                    data: formData,
                });
            });
        }
    </script>
@endsection
