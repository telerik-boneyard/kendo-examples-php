<!doctype html>
<html>
    <head>
        <title>Asynchronous upload</title>
        <link href="kendo.common.css" rel="stylesheet"/>
        <link href="kendo.default.css" rel="stylesheet"/>
        <script src="jquery.js"></script>
        <script src="kendo.core.js"></script>
        <script src="kendo.upload.js"></script>
    </head>

    <body>
        <div style="width:60%">
            <input name="files[]" id="files" type="file" />
        </div>
        <script>
            $(document).ready(function() {
                $("#files").kendoUpload({
                    async: {
                        saveUrl: "save.php",
                        removeUrl: "remove.php",
                        removeField: "fileNames[]",
                        autoUpload: true
                    }
                });
            });
        </script>
    </body>
</html>

