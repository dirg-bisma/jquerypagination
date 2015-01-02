<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dirg
 * Date: 5/10/14
 * Time: 3:16 PM
 * To change this template use File | Settings | File Templates.
 */


class DocTemplate
{
    /**
     * ZipArchive
     *
     * @var \ZipArchive
     */
    private $_objZip;

    /**
     * @var string
     */
    private $_tempFileName;

    /**
     * Document XML
     *
     * @var string
     */
    private $_documentXML;

    /**
     * Create a new Template Object
     *
     * @param string $strFilename
     */
    public function __construct($file)
    {
        if(! file_exists($file)) {
            throw new \Exception('file gak ketemu');
        }
        $path = dirname($file);
        $this->_tempFileName = $path.DIRECTORY_SEPARATOR.'__tmp'.time().'.docx';

        copy($file, $this->_tempFileName);

        $this->_objZip = new ZipArchive;
        $this->_objZip->open($this->_tempFileName);

        $this->_documentXML = $this->_objZip->getFromName('word/document.xml');
    }

    /**
     * Set a Template value
     *
     * @param mixed $search
     * @param mixed $replace
     */
    public function setValue($search, $replace)
    {
        if(substr($search, 0, 2) !== '{{' && substr($search, -2) !== '}}') {
            $pattern = '/(\{\{'.$search.'\}\})/';

        } else {
            $pattern = $search;
        }

        if(!is_array($replace)) {
            $replace = utf8_encode($replace);
        }

        $this->_documentXML = preg_replace($pattern, $replace, $this->_documentXML);
    }

    /**
     * @param   string $strFilename
     * @return  string filename
     * @throws  Exception
     */
    public function save($strFilename)
    {
        if(file_exists($strFilename)) {
            unlink($strFilename);
        }

        $this->_objZip->addFromString('word/document.xml', $this->_documentXML);

        if($this->_objZip->close() === false) {
            throw new Exception('Could not close zip file.');
        }

        rename($this->_tempFileName, $strFilename);
        return $strFilename;
    }
}
