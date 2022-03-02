<?php
	/**
	 Navigation bars are used as menus, in this practice we will create a twolevel navigation bar that will follow the same structure as your units folders and exercises.
	 */
	class NavigationBar 
	{
		private $navbarHtmlCode;

		function __construct(string $dir)
		{
			$this->navbarHtmlCode = '<div class="NavbarArea">
							<ul>';
			$files = scandir($dir, SCANDIR_SORT_ASCENDING);
			foreach ($files as $value) {
				if($value != "." && $value !="..")
				{
					$currentDir = $dir.DIRECTORY_SEPARATOR.$value;
					if(is_dir($currentDir))
					{
						$child = scandir($currentDir);
						if(count($child)>2)
						{
							//create the unit tabs
							$this->navbarHtmlCode.='<li class="dropdown">
							<a class="dropbtn" href="index.php?unit='.$value.'">'.$value.'</a>
							<div class="dropdown-content">';
							foreach ($child as $childValue) {
								//Dropdown only shows folders excluding the folders . and .., no other files
								if(is_dir($currentDir.DIRECTORY_SEPARATOR.$childValue) && $childValue != "." && $childValue !="..")
								{
									//create the sub tabs
									$this->navbarHtmlCode.='<a href="index.php?unit='.$value.'&lesson='.$childValue.'">'.$childValue.'</a>';
								}
							}
							$this->navbarHtmlCode.='</div>
							</li>';
						}
					}
				}
			}
			$this->navbarHtmlCode.='</ul>
			</div>';
		}
		public function navbarHtmlCode()
		{
			return $this->navbarHtmlCode;
		}
	}
	/**
	 Trees have been used for decades to show the hierarchy among a set of files. There are no native trees in HTML, but they can be built using lists (again) and proper styling. 
	 */
	class Tree
	{
		private $stylesheet;
		private $treeHtmlCode;
		function __construct(string $dir, $arrayGet)
		{
			//head part
			require("phpFileTree/php_file_tree.php");

			$this->stylesheet = '
			<script src="phpFileTree/jquery-1.3.2.js" type="text/javascript"></script>
			<script src="phpFileTree/php_file_tree_jquery.js" type="text/javascript"></script>';
			
			//depending on whether we are in a unit or in a lesson we will construct diferrent paths					
			$this->treeHtmlCode = '<div class="treeArea">';
			if(isset($arrayGet["lesson"]))
			{
				$this->treeHtmlCode.= php_file_tree($dir.DIRECTORY_SEPARATOR.$arrayGet["unit"].DIRECTORY_SEPARATOR.$arrayGet["lesson"], 'index.php?unit='.$arrayGet["unit"].'&lesson='.$arrayGet["lesson"].'&show=output');
			}else
			{
				$this->treeHtmlCode.= php_file_tree($dir.DIRECTORY_SEPARATOR.$arrayGet["unit"], 'index.php?unit='.$arrayGet["unit"]);
			}
			$this->treeHtmlCode.= "</div>";
		}
		public function getTreeHtmlCode()
		{
			return $this->treeHtmlCode;
		}
		public function getTreeStyle()
		{
			return $this->stylesheet;
		}
	}
	/**
	 * 
	 */
	class Content
	{
		private $localhostPath = "API/PhPExercise/";
		private $path;
		private $stylesheet;
		private $buttonHtmlCode;
		private $contentHtmlCode;
		private $downloadOption;
		function __construct(string $dir, $arrayGet)
		{
			$this->path = $dir;
			//if we are going to show the source of an exercise we will include the highligt, if not we are not going to add unnecessary code
			if(isset($arrayGet["show"]) && $arrayGet["show"]=="source")
			{
				require_once __DIR__."/highlight.php-9.18/Highlight/Autoloader.php";
				spl_autoload_register("Highlight\\Autoloader::load");
				$this->stylesheet = '<link rel="stylesheet" type="text/css" href="highlight.php-9.18/styles/current/'.$arrayGet["style"].'">';
			}
			//depending on whether we are in a unit or in a lesson we will construct diferrent paths, principally for the download options
			if(isset($arrayGet["exercise"]))
			{
				$url = 'index.php?unit='.$arrayGet["unit"].'&lesson='.$arrayGet["lesson"].'&exercise='.$arrayGet["exercise"].'&style='.$arrayGet["style"];
			}
			else if(isset($arrayGet["lesson"]))
			{
				$url = 'index.php?unit='.$arrayGet["unit"].'&lesson='.$arrayGet["lesson"];
			}
			else
			{
				$url = 'index.php?unit='.$arrayGet["unit"];
			}

			//BUTTONS
			$dissabled = (isset($arrayGet["exercise"])) ? "" : "disabled";
			$this->contentHtmlCode = '<div class = "ContentArea">
											<div class="buttonOptions">
												<a href="'.$url.'&show=source"><button '.$dissabled.'>Show Source &#128196;</button></a>
												<a href="'.$url.'&show=output"><button '.$dissabled.'>Show Output &#128221;</button></a>
												<a href="'.$url.'&action=download"><button '.$dissabled.'>Download &#128190;</button></a>
												<a href="'.$url.'&action=downloadAll"><button>Download ALL &#128193;</button></a>
												<li class="dropdown">
													<button class="" '.$dissabled.'>Output Style &#9196;</button>
													<div class="dropdown-content">';
			//Dropdown of outputs styles
			if(isset($arrayGet["exercise"]))
			{
				$styles = scandir("highlight.php-9.18".DIRECTORY_SEPARATOR."styles".DIRECTORY_SEPARATOR ."current", SCANDIR_SORT_ASCENDING);
				foreach ($styles as $value) 
				{
					if($value != "." && $value !="..")
					{
						$this->contentHtmlCode.='<a href="index.php?unit='.$arrayGet["unit"].'&lesson='.$arrayGet["lesson"].'&exercise='.$arrayGet["exercise"].'&show=source&style='.$value.'">'.$value.'</a>';
					}
				}
			}

			$this->contentHtmlCode.='</div></li><a href="'.$url.'&action=delete"><button '.$dissabled.'>Delete &#128686;</button></a>';

			$this->contentHtmlCode.= '</div>
											<div class="showArea">';

			//Depending of the show value we will show the exercise by its output or its source 
			if(isset($arrayGet["show"]))
			{
				switch ($arrayGet["show"]) {
					case 'output':
						$this->showOutput($arrayGet);
						break;
					case 'source':
						$this->showSource($arrayGet);
						break;
				}
			}
			//if thers an action (!update) we will create a download class
			if(isset($arrayGet["action"]) && $arrayGet["action"]!="update")
			{
				if($arrayGet["action"]!="delete")
				{
					$this->downloadOption = new download($this->path, $arrayGet);
				}
				else
				{
					unlink($this->path.DIRECTORY_SEPARATOR.$arrayGet["unit"].DIRECTORY_SEPARATOR.$arrayGet["lesson"].DIRECTORY_SEPARATOR.$arrayGet["exercise"]);
					header("Location: index.php?&unit=".$arrayGet["unit"]."&lesson=".$arrayGet["lesson"]);
				}
			}

			$this->contentHtmlCode.="</div></div>";
						
		}
		public function showSource($arrayGet)
		{
			$highlight = new Highlight\Highlighter();
			$code = $highlight->highlight("php", file_get_contents($this->path.DIRECTORY_SEPARATOR.$arrayGet["unit"].DIRECTORY_SEPARATOR.$arrayGet["lesson"].DIRECTORY_SEPARATOR.$arrayGet["exercise"]));
			$this->contentHtmlCode.= '<pre><code class="hljs <?=$r->language; ?>">'.$code->value.'</code></pre>';
		}
		public function showOutput($arrayGet)
		{
				$filePath=DIRECTORY_SEPARATOR.$arrayGet["unit"].DIRECTORY_SEPARATOR.$arrayGet["lesson"].DIRECTORY_SEPARATOR.$arrayGet["exercise"];
				$extension = pathinfo($this->path.$filePath, PATHINFO_EXTENSION);	
				if($extension == "jpg" || $extension == "png")	
				{		
					$this->contentHtmlCode.='<img src="http://'.$_SERVER["HTTP_HOST"].DIRECTORY_SEPARATOR.$this->localhostPath.$filePath.'">';
				}
				else
				{
					$this->contentHtmlCode.=file_get_contents("http://".$_SERVER["HTTP_HOST"]."/".$this->localhostPath.$filePath);
				}
		}
		
		public function getContentHtmlCode()
		{
			return $this->contentHtmlCode;
		}
		public function getStylesheet()
		{
			return $this->stylesheet;
		}
	}

	/**
	 * 
	 */
	class download
	{
		private $path;
		function __construct(string $dir, $arrayGet)
		{
			$this->path = $dir;
			switch ($arrayGet["action"])
			{
				case 'download':
					$this->download($arrayGet);
					break;
				case 'downloadAll':
					$this->downloadAll($arrayGet);
					break;
			}
		}
		public function download($arrayGet)
		{
			$fichero = $this->path.DIRECTORY_SEPARATOR.$arrayGet["unit"].DIRECTORY_SEPARATOR.$arrayGet["lesson"].DIRECTORY_SEPARATOR.$arrayGet["exercise"];
			if (file_exists($fichero)) 
			{
			    header('Content-Description: File Transfer');
			    header('Content-Type: application/octet-stream');
			    header('Content-Disposition: attachment; filename="'.basename($fichero).'"');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate');
			    header('Pragma: public');
			    header('Content-Length: ' . filesize($fichero));
			    readfile($fichero);
			    exit;
			}
		}
		public function downloadAll($arrayGet)
		{
			$dir = $this->path.DIRECTORY_SEPARATOR.$arrayGet["unit"];
			$zip_file = $arrayGet["unit"].'.zip';
			if(isset($arrayGet["lesson"]))
			{
				$dir.=DIRECTORY_SEPARATOR.$arrayGet["lesson"];
				$zip_file=$arrayGet["unit"]."_".$arrayGet["lesson"].'.zip';
			}
			// Get real path for our folder
			$rootPath = realpath($dir);

			// Initialize archive object
			$zip = new ZipArchive();
			$zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

			// Create recursive directory iterator
			/** @var SplFileInfo[] $files */
			$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootPath),RecursiveIteratorIterator::LEAVES_ONLY);

			foreach ($files as $name => $file)
			{
			    // Skip directories (they would be added automatically)
			    if (!$file->isDir())
			    {
			        // Get real and relative path for current file
			        $filePath = $file->getRealPath();
			        $relativePath = substr($filePath, strlen($rootPath) + 1);

			        // Add current file to archive
			        $zip->addFile($filePath, $relativePath);
			    }
			}

			// Zip archive will be created only after closing object
			$zip->close();


			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($zip_file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($zip_file));
			readfile($zip_file);
		}
		
	}

	class Upload
	{
	  private $uploadHTMLCode;
	  function __construct($dir, $arrayGet)
	  {
	  	// create a form that will send the variables in post form and charge the upload.php file to upload the file
	    $this->uploadHTMLCode = '<div class="Update"><form enctype="multipart/form-data" action="upload.php" method="POST">
	    <p>Upload your file here:</p>
	    <p>Destination path: '.$dir.'/'.$arrayGet["unit"].'/'.$arrayGet["lesson"].'</p>
	    <input type="file" name="uploaded_file"></input><br />
	    <input type="hidden" name="dir" value="'.$dir.'">
	    <input type="hidden" name="unit" value="'.$arrayGet["unit"].'">
		<input type="hidden" name="lesson" value="'.$arrayGet["lesson"].'"><br>
		<input type="submit" value="Upload">
	  </form></div>';
	  }
	  public function getUploadHTMLCode()
	  {
	    return $this->uploadHTMLCode;
	  }
	}

	
?>