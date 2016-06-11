@extends('layouts.app')

@section('content')
<script>

  function focusTimeline(id) {
    timeline.focus(id);
    timeline.setSelection(id);
    $('html, body').animate({scrollTop : 0},400);
  }

  function fillData(id) {
    $('#myModal').modal('show');

    $.get('{{url("/api/proker")}}/' + id, function(data) {
      $('input[name="editid"]').val(data.id);
      $('input[name="editdivision"]').val(data.division);
      $('input[name="editname"]').val(data.name);
      $('input[name="editdescription"]').val(data.description);
      $('input[name="editstartDate"]').val(moment(data.start_date).format('MM/DD/YYYY'));
      $('input[name="editendDate"]').val(moment(data.end_date).format('MM/DD/YYYY'));
      $('input[name="editdone"]').val(data.done);
    });
  }

  function deleteRow(id) {

    swal({
      title: 'Hapus?',
      text: "Awas nanti hilang!",
      type: 'warning',
      showCancelButton: true,
      input: 'password',
    }).then(function(password) {
      if (password) {
        $.ajax({
          url: '{{url("/api/proker")}}/' + id,
          type: 'DELETE',
          data: {password: password},
          success: function(data) {
            swal("Sukses!", "Sukses mendelete " + data.name + "!", "success");
            refreshPage();
          },
          error: function(error) {
            swal("Gagal!", error.message, "error");                        
          }
        });
      }
    });
  }

  function refreshPage() {
    location.reload();
  }
</script>

<div class="row">
  <h4>Timeline</h4>
  <div id="timeline"></div>  
</div>
<br/>

<hr>

<div class="row vdivide">

  <div class="col-md-3">
    <div id="new">
      <center><div id="deadline-datepicker" class="hidden-xs"></div></center>
      <hr class="hidden-xs">
      <h4>Tambah Proker</h4>
      <form id="proker-form">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Divisi</label>
              <div id="division_select_container"></div>
            </div>
            <div class="form-group">
              <label for="">Nama Proker</label>
              <input type="text" class="form-control" placeholder="Nama proker" name="name"/>
            </div>
            <div class="form-group">
              <label for="">Deskripsi Proker</label>
              <input type="text" class="form-control" placeholder="Deskripsi proker" name="description"/>
            </div>              
            <div class="form-group">
              <label for="">Tanggal Pelaksanaan</label>
              <div class="input-daterange input-group" id="datepicker">
                  <input type="text" class="input-sm form-control" name="startDate"/>
                  <span class="input-group-addon">to</span>
                  <input type="text" class="input-sm form-control" name="endDate"/>
              </div>
            </div>
            <button type="submit" class="btn btn-default btn-block">Tambah</button>              
            <hr>
          </div>
        </div>
      </form>      
    </div>
  </div>

  <div class="col-md-9">
    
    @foreach (Scheduler\Division::all() as $division)
      <div class="panel panel-default panel-body" id="{{$division->shortname}}">        
        <h4>
          <span data-toggle="tooltip" data-placement="top" 
          title="
            @foreach($division->members as $m) 
              {{$m->name}} <br>
            @endforeach
          ">
            {{$division->name}}            
          </span>
        </h4>
        @if ($division->prokers->count() != 0)
          <div class="table-responsive">
            <table class="table table-condensed">
              <thead>
                <tr>
                  <th width="25%">Proker</th>
                  <th width="15%">Pelaksanaan</th>
                  <th width="30%">Deskripsi</th>
                  <th width="20%"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($division->prokers->sortBy('start_date') as $proker)
                  <tr id="row-{{$proker->id}}">
                    <td>{{$proker->name}}</td>
                    <td>
                      {{
                        $proker->start_date == $proker->end_date
                        ? Carbon\Carbon::parse($proker->start_date)->format('M j')
                        : Carbon\Carbon::parse($proker->start_date)->format('M j') . ' - ' 
                          . Carbon\Carbon::parse($proker->end_date)->format('M j')
                      }}
                    </td>
                    <td>{{$proker->description}}</td>
                    <td>
                      <div class="btn-group btn-group-xs">
                        <button class="btn btn-link" onclick="fillData({{$proker->id}})">Edit</button>
                        <button class="btn btn-link" onclick="deleteRow({{$proker->id}})">Delete</button>
                        <button class="btn btn-link" onclick="focusTimeline({{$proker->id}})">Highlight</button>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @else
          <p>Tidak ada proker</p>
        @endif
      </div>
    @endforeach
  </div>

</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Proker</h4>
      </div>
      <div class="modal-body">
        <form id="proker-form">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Nama Proker</label>
                <input type="text" class="form-control" placeholder="Nama proker" name="editname"/>
              </div>
              <div class="form-group">
                <label for="">Deskripsi Proker</label>
                <input type="text" class="form-control" placeholder="Deskripsi proker" name="editdescription"/>
              </div>              
              <div class="form-group">
                <label for="">Tanggal Pelaksanaan</label>
                <div class="input-daterange input-group" id="datepicker">
                    <input type="text" class="input-sm form-control" name="editstartDate"/>
                    <span class="input-group-addon">to</span>
                    <input type="text" class="input-sm form-control" name="editendDate"/>
                </div>
              </div>
              <div class="checkbox">
                <label for="">
                  <input type="checkbox" name="editdone">Selesai
                </label>
              </div>
              <input type="text" name="editid" hidden>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="btn_edit">Save changes</button>
      </div>
    </div>
  </div>
</div>



<script type="text/babel">

  var DivisiSelect = React.createClass ({
    getInitialState: function() {
      return {data: [], chosenDivision: ''};
    },

    componentDidMount: function() {
      this.serverRequest = $.get('{{route('api.division.index')}}', function (result) {
        this.setState({data: result, chosenDivision: this.state.chosenDivision});
      }.bind(this));
    },

    handleDivisionChange: function(e) {
      this.setState({data: this.state.data, chosenDivision: e.target.value});
    },

    render: function() {
      var options = this.state.data.map(function (divisi) {
        return (
          <option value={divisi.id} key={divisi.id}>{divisi.shortname}</option>
        );
      });
      return (
        <select className="form-control" name="division"
                value={this.state.chosenDivision} 
                onChange={this.handleDivisionChange}>
          {options}
        </select>        
      )
    }
  });

  ReactDOM.render(
    <DivisiSelect />,
    document.getElementById('division_select_container')
  );
</script>

<script type="text/javascript">

  $(function () {
    $('[data-toggle="tooltip"]').tooltip({html: true})
  })

  $('#proker-form').submit(function(e) {
    e.preventDefault();

    swal({
      title: 'Tambah Proker?',
      text: "Silahkan masukan password!",
      type: 'question',
      input: 'password',
      showCancelButton: true,
    }).then(function(password) {
      if (password) {
        $.post('{{route("api.proker.store")}}', {
            name : $('input[name=name]').val(),
            description : $('input[name=description]').val(),
            startDate : moment($('input[name=startDate]').val()).format('YYYY-MM-DD'),
            endDate : moment($('input[name=endDate]').val()).format('YYYY-MM-DD'),
            division : $('select[name=division]').val(),
            password : password
          }, function(data) {
            swal("Sukses!", "Selamat melayani di " + data.name + "!", "success");
            $('select[name="division"]').val('');
            $('input[name="name"]').val('');
            $('input[name="description"]').val('');
            $('input[name="startDate"]').val('');
            $('input[name="endDate"]').val('');
            refreshPage();
          }).fail(function(error) {
            swal("Gagal!", error.message, "error");            
          });
      }
    })
  })

  $('#btn_edit').click(function() {
    $('#myModal').modal('hide');
    swal({
      title: 'Yakin?',
      text: "Awas ada yang salah!",
      type: 'question',
      showCancelButton: true,
      input: 'password',
    }).then(function(password) {
      if (password) {
        $.ajax({
          url: '{{url("/api/proker")}}/' + $('input[name="editid"]').val(),
          type: 'PUT',
          data: {
            password: password,
            name: $('input[name="editname"]').val(),
            description: $('input[name="editdescription"]').val(),
            startDate: $('input[name="editstartDate"]').val(),
            endDate: $('input[name="editendDate"]').val(),
            done: $('input[name="editdone"]').value,
          },
          success: function(data) {
            swal("Sukses!", "Sukses mengupdate " + data.name + "!", "success");
            refreshPage();
          },
          error: function(error) {
            swal("Gagal!", error.message, "error");                        
          }
        });
      }
    });
  });

  $('.input-daterange').datepicker({todayHighlight: true});
  $('#deadline-datepicker').datepicker({todayHighlight: true});

  var container = document.getElementById('timeline');
  var options = {
    "align": "center",
    "height": "80vh",
    "moveable": true,
    "orientation": {
      "axis": "top",
      "item": "top",
    },
    "showCurrentTime": true,
    "type": "range"
  }

  var timeline;
  $.get("{{route('timeline')}}", function(data) {
    timeline = new vis.Timeline(container, data.items, data.groups, options);
  });

  $(document).on('click', 'a[href^="#"]', function(e) {
      // target element id
      var id = $(this).attr('href');

      // target element
      var $id = $(id);
      if ($id.length === 0) {
          return;
      }

      // prevent standard hash navigation (avoid blinking in IE)
      e.preventDefault();

      // top position relative to the document
      var pos = $(id).offset().top - 50;

      // animated top scrolling
      $('body, html').animate({scrollTop: pos});
  });


  if($(window).width() > 1024){
    $('#new').affix({
      offset: {
          top: $('#new').offset().top + 500
      }
    });
  }

</script>

<style>
.vis-item .vis-item-overflow {
  overflow: visible;
}

.affix {
  top: 40px;
  width: 263px;
}

</style>

@endsection
