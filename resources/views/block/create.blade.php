<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/pell/dist/pell.min.css">

    <title>Block creating</title>
</head>
<body>
<div class="container">
    {{--    <h3>Block content creating</h3>--}}
    <form method="POST" action="/blocks/store">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">Block name</label>
            <input name='name' type="text" class="form-control" id="name" aria-describedby="name"
                   placeholder="Enter block name" required>
        </div>
        <div class="form-group">
            <label for="type_id">Block type</label>
            <select name='type_id' id='type_id' class="form-control">
                @foreach ($types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="editor-content">Block content</label>
            <div id="editor-content" class="pell"></div>
            <label for="editor-content">Block content HTML:</label>
            <textarea name='content' class="form-control" id="content" rows="5" required
                      style="white-space:pre-wrap;"></textarea>
        </div>
        <div class="form-group">
            <label for="remote_styles">Remote styles</label>
            <textarea name='remote_styles' class="form-control" id="remote_styles" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label for="styles">Styles</label>
            <textarea name='styles' class="form-control" id="styles" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="remote_scripts">Remote scripts</label>
            <textarea name='remote_scripts' class="form-control" id="remote_scripts" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label for="scripts">Scripts</label>
            <textarea name='scripts' class="form-control" id="scripts" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
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

<script src="https://unpkg.com/pell"></script>


<script>
    // Initialize pell on an HTMLElement
    pell.init({
        // <HTMLElement>, required
        element: document.getElementById('editor-content'),

        // <Function>, required
        // Use the output html, triggered by element's `oninput` event
        onChange: html => {
            document.getElementById('content').textContent = html
        },

        // <string>, optional, default = 'div'
        // Instructs the editor which element to inject via the return key
        defaultParagraphSeparator: 'div',

        // <boolean>, optional, default = false
        // Outputs <span style="font-weight: bold;"></span> instead of <b></b>
        styleWithCSS: true,

        // <Array[string | Object]>, string if overwriting, object if customizing/creating
        // action.name<string> (only required if overwriting)
        // action.icon<string> (optional if overwriting, required if custom action)
        // action.title<string> (optional)
        // action.result<Function> (required)
        // Specify the actions you specifically want (in order)
        actions: [
            'bold',
            {
                name: 'custom',
                icon: 'C',
                title: 'Custom Action',
                result: () => console.log('Do something!')
            },
            'underline',
            'italic',
            'strikethrough',
            'heading1',
            'heading2',
            'paragraph',
            'quote',
            'olist',
            'ulist',
            'code',
            'line',
            'link',
            'image'
        ],

        // classes<Array[string]> (optional)
        // Choose your custom class names
        classes: {
            actionbar: 'pell-actionbar',
            button: 'pell-button',
            content: 'pell-content',
            selected: 'pell-button-selected'
        }
    })


</script>
</body>
</html>
