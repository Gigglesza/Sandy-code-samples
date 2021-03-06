<?php
function motopressCERenderShortcode() {
    require_once dirname(__FILE__).'/../verifyNonce.php';
    require_once dirname(__FILE__).'/../settings.php';
    require_once dirname(__FILE__).'/../access.php';
    require_once dirname(__FILE__).'/../functions.php';
    require_once dirname(__FILE__).'/../getLanguageDict.php';
    require_once dirname(__FILE__).'/Shortcode.php';

    $motopressCELang = motopressCEGetLanguageDict();

    if (
        isset($_POST['closeType']) && !empty($_POST['closeType']) &&
        isset($_POST['shortcode']) && !empty($_POST['shortcode'])
    ) {
        global $motopressCESettings;
        $errors = array();

        $closeType = $_POST['closeType'];
        $shortcode = $_POST['shortcode'];
        $parameters = null;
        if (isset($_POST['parameters']) && !empty($_POST['parameters'])) {
            $parameters = json_decode(stripslashes($_POST['parameters']));
            if (!$parameters) {
                $errors[] = $motopressCELang->CERenderShortcodeError;
            }
        }
        $classes = null;
        if (isset($_POST['classes']) && !empty($_POST['classes'])) {
            $classes = $_POST['classes'];
        }

        if (empty($errors)) {
            $s = new MPCEShortcode();
            $content = null;
            if (isset($_POST['content']) && !empty($_POST['content'])) {
                $content = stripslashes($_POST['content']);

                if (isset($_POST['wrapRender']) && $_POST['wrapRender'] === 'true') {
                    $content = motopressCECleanupShortcode($content);
                    global $motopressCELibrary;
                    $motopressCELibrary = new MPCELibrary();
                    $content = motopressCEParseObjectsRecursive($content);
                }
            }

            $str = $s->toShortcode($closeType, $shortcode, $parameters, $classes, $content);
            echo do_shortcode($str);
        }

        if (!empty($errors)) {
            if ($motopressCESettings['debug']) {
                print_r($errors);
            } else {
                motopressCESetError($motopressCELang->CERenderShortcodeError);
            }
        }
    } else {
        motopressCESetError($motopressCELang->CERenderShortcodeError);
    }
    exit;
}