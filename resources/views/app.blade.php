<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SPA Skeleton') }}</title>

    <link rel="stylesheet" href="https://static2.sharepointonline.com/files/fabric/office-ui-fabric-js/1.2.0/css/fabric.min.css">
    <link rel="stylesheet" href="https://static2.sharepointonline.com/files/fabric/office-ui-fabric-js/1.2.0/css/fabric.components.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
    <ou-command-bar>
        <template slot='main'>
            <ou-search-box type='commandBar' placeholder='Search' />
            <ou-command-button icon='CircleRing'>Command</ou-command-button>
            <ou-command-button icon='CircleRing'>Command</ou-command-button>
            <ou-command-button icon='CircleRing'>Command</ou-command-button>
        </template>
        <template slot='side'>
            <ou-command-button icon='CircleRing'>Command</ou-command-button>
            <ou-contextual-menu>
            <ou-command-button icon='Print' type='dropdown'>Print</ou-command-button>
            <div slot='list'>
                <ou-contextual-menu-item name='Animals' />
                <ou-contextual-menu-item name='Books' />
                <ou-contextual-menu-item name='Education' />
                <ou-contextual-menu-item name='Music' />
                <ou-contextual-menu-item name='Sports' disabled />
            </div>
            </ou-contextual-menu>
            <ou-command-button icon='Add'>New</ou-command-button>
        </template>
    </ou-command-bar>


        <ou-button>Create Account</ou-button>


        <ou-list-item
  primaryText='Alton Lafferty'
  secondaryText='Meeting notes'
  tertiaryText='Today we discussed the importance of a, b, and c in regards to d.'
  metaText='2:42p'>
  <ou-list-actions>
    <ou-list-action-item icon='Mail'></ou-list-action-item>
    <ou-list-action-item icon='Delete'></ou-list-action-item>
    <ou-list-action-item icon='Flag'></ou-list-action-item>
    <ou-list-action-item icon='Pinned'></ou-list-action-item>
  </ou-list-actions>
</ou-list-item>

    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
