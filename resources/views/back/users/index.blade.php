@extends('admin.app')
{{-- @section('content') --}}

@section('content')
<html>

<head>

{{-- link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 --}}



    <title>Smart Conseil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">



    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>




    <style>
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        nav .flex-start input {
            height: 40px;
            outline: none;
            font-size: 1rem;
            color: #707070;
            margin-top: 8px;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 0 10px;
        }

        nav .flex-end input {
            height: 40px;
            outline: none;
            font-size: 1rem;
            color: #707070;
            margin-top: 8px;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 0 10px;
        }

        .sc {
            height: 30px;
            outline: none;
            font-size: 1rem;
            color: #707070;
            margin-top: 8px;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 0 5px;
        }

        .ab {
            background-color: #bb2782;
            border: none;
            color: white;
            padding: 10px;
            text-decoration: none;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 6px;
        }

        .ab:hover {
            opacity: 0.7;
        }
    </style>
</head>

<body>
    <form action="{{ route('users.filter') }}" method="GET">
        <nav>
            <div class="flex-start">
                {{-- <input type="text" name="last_name" value="{{ $last_name ?? '' }}" placeholder="Last Name">

                <input type="text" name="email" value="{{ $email ?? '' }}" placeholder="Email"> --}}
            </div>
            <div class="flex-end">
                <input type="text" name="last_name" value="{{ $last_name ?? '' }}" placeholder="Last Name">

                <input type="text" name="email" value="{{ $email ?? '' }}" placeholder="Email">
               
                <button class="ab">Rechercher</button>
            </div>
        </nav>

    </form>

    <br>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
           
                <th>Nom et Prénom</th>
               
                <th>E-Mail</th>
             
                <th>Date inscription</th>

           

                <th>Status</th>
                <th>Role</th>
              
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($users) && $users->count())
            @foreach($users as $key => $user)
            <tr>
                <td>{{$user->id}}</td>

                
                <td>{{$user->last_name}}</td>
               
                <td>{{$user->email}}</td>
              
           
             
                <td>{{$user->created_at}}</td>
                <td>
                    <a href="user/{{$user->id}}" class="btn btn-sm btn-{{$user->status ? 'success':'danger'}}">
                        {{$user->status ? 'Activé':'inactivé'}}
                    </a>
                </td>
                <td>{{$user->role}}</td>
               

               
            
                <td data-label="Actions">
                 
                    <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>

                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip"
                            title='Delete'>Delete</button>

                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="10">There are no data.</td>
            </tr>
            @endif
        </tbody>
    </table>


    <div class="d-flex justify-content-center">

        {{ $users->links('back.users.pagination') }}
    </div>


</body>

</html>

<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 20px;
        font-family: sans-serif;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table td,
    .table th {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: center;
        font-size: 16px;
    }

    .table th {
        background-color: #bb2782;
        color: #ffffff;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f5f5f5;
    }

    /*responsive*/

    @media (max-width: 800px) {
        .table thead {
            display: none;
        }

        .table,
        .table tbody,
        .table tr,
        .table td {
            display: block;
            width: 100%;
        }

        .table tr {
            margin-bottom: 15px;
        }

        .table td {
            text-align: right;
            padding-left: 50%;
            text-align: right;
            position: relative;
        }

        .table td::before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 50%;
            padding-left: 15px;
            font-size: 15px;
            font-weight: bold;
            text-align: left;
        }
    }

    .upload {
        width: 70px;
        position: relative;
        margin: auto;
    }

    .upload img {
        border-radius: 50%;
        border: 2px solid #eaeaea;
    }

    .upload .round {
        position: absolute;
        bottom: 0;
        right: 0;
        background: #bb2782;
        width: 29px;
        height: 29px;
        line-height: 30px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
    }

    .upload .round input[type="file"] {
        position: absolute;
        transform: scale(2);
        opacity: 0;
    }

    input[type="file"]::-webkit-file-upload-button {
        cursor: pointer;
    }

    .column {
        display: flex;
        column-gap: 15px;
    }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });

</script>


@endsection
