<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;


class UploadController extends \UniSharp\LaravelFilemanager\Controllers\UploadController
{
    protected $errors;

    public function __construct()
    {
        parent::__construct();
        $this->errors = [];
    }

    /**
     * Upload files
     *
     * @param void
     * @return string
     */
    public function upload()
    {
        $uploaded_files = request()->file('upload');
        $error_bag = [];
        $new_filename = null;

        foreach (is_array($uploaded_files) ? $uploaded_files : [$uploaded_files] as $file) {
            try {
                $new_filename = $this->lfm->upload($file);
            } catch (\Exception $e) {
                Log::error($e->getMessage(), [
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]);
                array_push($error_bag, $e->getMessage());
            }
        }

        if (is_array($uploaded_files)) {
            $response = count($error_bag) > 0 ? $error_bag : array(parent::$success_response);
        } else { // upload via ckeditor 'Upload' tab
            if (is_null($new_filename)) {
                $response = $error_bag[0];
            } else {
                return $this->useFile($this->lfm->setName($new_filename)->url());
            }
        }

        return response()->json($response);
    }

    private function useFile($new_filename)
    {
        $file = $new_filename;

        $responseType = request()->input('responseType');
        if ($responseType && $responseType == 'json') {
            return [
                "uploaded" => 1,
                "fileName" => $new_filename,
                "url" => $file,
            ];
        }

        return "<script type='text/javascript'>

        function getUrlParam(paramName) {
            var reParam = new RegExp('(?:[\?&]|&)' + paramName + '=([^&]+)', 'i');
            var match = window.location.search.match(reParam);
            return ( match && match.length > 1 ) ? match[1] : null;
        }

        var funcNum = getUrlParam('CKEditorFuncNum');

        var par = window.parent,
            op = window.opener,
            o = (par && par.CKEDITOR) ? par : ((op && op.CKEDITOR) ? op : false);

        if (op) window.close();
        if (o !== false) o.CKEDITOR.tools.callFunction(funcNum, '$file');
        </script>";
    }
}
