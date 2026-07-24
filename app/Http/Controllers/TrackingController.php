<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DownloadLog;

class TrackingController extends Controller
{
    public function redirect(Request $request)
    {
        $url = $request->query('url');
        $repoName = $request->query('repo');
        $type = $request->query('type'); // 'click_source' atau 'click_doi'
        $title = $request->query('title');
        
        if ($url) {
            try {
                DownloadLog::create([
                    'repository_name' => $repoName,
                    'download_type' => $type,
                    'article_title' => $title
                ]);
            } catch (\Exception $e) {
                // Abaikan error agar user tetap bisa diredirect
            }
            
            return redirect($url);
        }
        
        return redirect()->back();
    }
}
