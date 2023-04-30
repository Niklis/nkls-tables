@props(['class'])

<div class="d-flex flex-column gap-3">
    <div class="overflow-x-auto shadow rounded-1">
        <h3>custom</h3>
        <h4>{{dd($this->columns())}}</h4>
        <table class="w-100 text-sm-start text-secondary {{$class}}">
            <thead>
                <tr class="bg-white">
                    @foreach ($this->columns() as $column)
                    <x-dynamic-component 
                    :component="$column->th" 
                    :value="$column->label"
                    :class="$column->class"/>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($this->data() as $row)
                    <tr class="bg-white">
                        @foreach ($this->columns() as $column)
                            <x-dynamic-component 
                            :component="$column->td" 
                            :value="$column->getValue($row, $column->key)"
                            :class="$column->class"/>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $this->data()->links() }}
</div>
