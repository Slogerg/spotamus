<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpvoteController extends Controller
{
    public function upvote(Request $request)
    {
//        dd($request->all());
        $user_id = Auth::user()->id;
        $id = $request->id;
        $type = $request->type;
        $user_upvotes = DB::table('users_upvotes')
            ->where('user_id',$user_id)
            ->where('type',$type)
            ->where('entity_id',$id);


        if(is_null($user_upvotes->first())){
            DB::table('users_upvotes')->insert([
                'user_id' => $user_id,
                'entity_id' => $id,
                'type' => $type
            ]);

            if($type == 'artist' ){
                $entity = Artist::find($id);
                $upvotes = $entity->upvotes + 1;
                $entity->update(['upvotes' => $upvotes]);
            }
            if($type == 'event'){
                $entity = Event::find($id);
                $upvotes = $entity->upvotes + 1;
                $entity->update(['upvotes' => $upvotes]);
            }

            return response()->json([
                'number' => $upvotes,
                'type'   => 'upvote',
            ]);
        }else{
            $user_upvotes->delete();
            if($type == 'artist'){
                $entity = Artist::find($id);
                $upvotes = $entity->upvotes - 1;
                $entity->update(['upvotes' => $upvotes]);
            }
            if($type == 'event'){
                $entity = Event::find($id);
                $upvotes = $entity->upvotes - 1;
                $entity->update(['upvotes' => $upvotes]);
            }
            return response()->json([
               'number' => $upvotes,
               'type'   => 'downvote',
            ]);
        }

        if(isset($entity)){
            return redirect('/'.$type.'/'.$entity->slug);
        }else{
            abort(404);
        }





    }
}
