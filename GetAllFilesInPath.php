<?php
function GetAllFilesInPath($requestedPath, $recursive = true)
{
	// Initialize folder array
	$files = array();

	// Get directory contents

	if ($dirContents = scandir($requestedPath))
	{
		foreach ($dirContents as $entry)
		{
			// Skip . and ..
			if (($entry == '.') || ($entry == '..'))
			{
				continue;
			}

			// Put together the path for this directory entry
			$currentPath = $requestedPath . '/' . $entry;

			if (is_dir($currentPath) && $recursive)
			{

				// This entry is a folder, and we're recursive, so recurse
				$subfolderResults = GetAllFilesInPath($currentPath);

				// This adds sub arrays for sub folders
				$files[$currentPath] = $subfolderResults;

			}
			else
			{

				// This adds files to current folder
				$files['files'][] = $currentPath;

			}
		}
	}

	else
	{
		die('Folder "' . $requestedPath . '" could not be opened.');
	}

	return $files;
}
