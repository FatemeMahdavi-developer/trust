<?php

namespace App\base\class;


class admin_controller
{


    public function action($request, $model)
    {
        if (method_exists(self::class, $request->action_type)) {
            $action_Type = $request->action_type;
            return json_encode(self::$action_Type($model, $request));
        } else {
            return false;
        }
    }

    private function delete_all($model, $request)
    {
        // >where("admin_id",auth()->user()->id)
        $model::whereIn('id', $request->item)->delete();
        return true;
    }

    private function change_order($model, $request)
    {
        foreach ($request->item as $key => $value) {
            $order=to_english_numbers($request->order[$value]);
            $model::find($value)->update([
                'order' => $order
            ]);
        }
        return true;
    }
    private function change_state($model, $request)
    {
        foreach ($request->item as $id) {
            $module = $model::select('id','state')->find($id);
            if ($module["state"]) {
                $module->update(["state" => '0']);
            } else {
                $module->update(["state" => '1']);
            }
        }
        return true;
    }
    private function change_state_main($model, $request)
    {
        foreach ($request->item as $id) {
            $module = $model::select('id','state_main')->find($id);
            if ($request->change_state_main == '1') {
                $module->update(["state_main" => '1']);
            } else {
                $module->update(["state_main" => '0']);

            }
        }
        return true;
    }

    private function change_state_menu($model, $request)
    {
        foreach ($request->item as $id) {
            $module = $model::select('id','state_menu')->find($id);
            if ($request->change_state_menu == '1') {
                $module->update(["state_menu" => '1']);
            } else {
                $module->update(["state_menu" => '0']);

            }
        }
        return true;
    }

    private function change_state_item($model, $request){
        $module = $model::select(['id',$request->column_name])->find($request->item);
        if ($module[$request->column_name] == '0') {
            $module->update([$request->column_name => '1']);
        } else {
            $module->update([$request->column_name => '0']);

        }
        return true;
    }


}

