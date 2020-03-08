<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/fontawesome.min.js"
            integrity="sha256-7zqZLiBDNbfN3W/5aEI1OX/5uvck9V0yhwKOA9Oe49M=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/fontawesome.min.css"
          integrity="sha256-mM6GZq066j2vkC2ojeFbLCcjVzpsrzyMVUnRnEQ5lGw=" crossorigin="anonymous"/>
    <title>Email builder</title>
</head>
<body>
<style>
    .gu-mirror {
        display: none;
    }
</style>
<div class="container">
    <h2>Email compositor</h2>
    <div class="row">
        <div class="col-6">
            <h4>Preview:</h4>
            <div class="col border" style="height: 100%">
                <iframe id="iframe_preview" src="" style="display:none;" width="100%" height="100%"></iframe>
            </div>
        </div>
        <div class="col">
            <h4>Components order:</h4>
            <div id="left" class="col border" style="height: 400px"></div>
            <button type="button" class="btn btn-primary" id="build">Build preview</button>
            <a href="" id="fullscreen" style="display:none" target="_blank" class="btn btn-outline-primary">Open in fullscreen</a>
            <a href="" id="viewSource" style="display:none" target="_blank" class="btn btn-outline-primary">Open source code</a>
        </div>

        <div class="col">
            <h4>Components list:</h4>
            <div id="right" class="col border" style="height: 400px">
                @foreach ($blocks as $block)
                    <div class="border border-primary rounded-sm p-2 m-2" id="{{$block->id}}" class="ccsdffdfdf">
                        {{$block->name}}
                        <span class=" badge badge-primary">{{$block->type->name}}</span>
                        <div class="float-right flex-container row">
                            <button onclick='edit(this.dataset.id)' data-id="{{$block->id}}">✎</button>
                            <button data-id="{{$block->id}}">❌</button>
                        </div>
                    </div>
                @endforeach
            </div>
            <script>
                function edit(id) {
                    window.location.href = "blocks/" + id + "/edit";
                }
            </script>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createNewModal">Create new
            </button>

        </div>
    </div>
</div>

<div class="container" style="margin-top:50px">
    <div>Warnings:</div>
    <div class="row">
        <ul class="list-group">
            <li>AMP components not editable in WYSIWYG now. Only in HTML window.</li>
        </ul>
    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

<script>
    dragula([document.querySelector('#left'), document.querySelector('#right')], {
        copy: function (el, source) {
            return source === document.getElementById(left)
        },
        accepts: function (el, target) {
            return target !== document.getElementById(left)
        }
    });

    document.getElementById('build').onclick = function () {
        $(document).ready(function () {
            let blocks = $("#left").children();
            let ids = [];
            blocks.each(function () {
                console.log($(this).attr("id"));
                ids.push($(this).attr("id"));
            });

            axios.post('/constructPreview', {
                ids: ids
            })
                .then(function (response) {
                    $("#iframe_preview").attr('src', response.data.link);
                    $("#iframe_preview").show();
                    $("#fullscreen").attr('href', response.data.link);
                    $("#fullscreen").show();
                    $("#viewSource").attr('href', '/constructPreview/source/'+response.data.id);
                    $("#viewSource").show();
                    console.log(response);
                })
                .catch(function (error) {
                    alert('error. See console log...');
                    console.log(error);
                });
        });
    }
</script>
</body>
<!-- Modal -->
<div class="modal fade" id="createNewModal" tabindex="-1" role="dialog" aria-labelledby="createNewModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Block content creating</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: 1000px;">
                <iframe id="example_com" src="/blocks/create" width="100%" height="100%"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{--                            <button type="button" class="btn btn-primary">Save changes</button>--}}
            </div>
        </div>
    </div>
</div>
</html>
