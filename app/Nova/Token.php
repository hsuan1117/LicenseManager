<?php

namespace App\Nova;

use Gldrenthe89\NovaStringGeneratorField\NovaGeneratePassword;
use Gldrenthe89\NovaStringGeneratorField\NovaGenerateString;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasManyThrough;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Token extends Resource {
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Token::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'activated_ip'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request) {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make('project'),

            Text::make('name'),
            NovaGenerateString::make('content')->length(12)->excludeRules(['symbols', 'lowercase']),

            Text::make('限制驗證IP', 'activated_ip')->nullable(),
            Text::make('限制驗證uname', 'activated_uname')->nullable(),
            Text::make('限制驗證cpu', 'activated_cpu')->nullable(),
            Number::make('限制驗證次數', 'activated_limit')->default(function () {
                return 1;
            }),

            DateTime::make('過期時間', 'expires_at')->nullable(),

            HasMany::make('機器激活','activations',Activation::class)
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request) {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request) {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request) {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request) {
        return [];
    }

    public static function label() {
        return '金鑰';
    }

    public static function singularLabel() {
        return '金鑰';
    }
}
