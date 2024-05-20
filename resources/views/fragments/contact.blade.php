@php
    use App\Helpers\BladeTranslator;
@endphp
<div id="contact-section">
    <section class="header">
        <div class="p-3 p-md-5">
            <div class="container-fluid py-5">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-12 col-md-10 text-center">
                        <h1 class="display-3 fw-bold mb-4 text-center" data-aos="fade-left">
                            {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'section_contact.title'))) }}
                        </h1>
                        <p class="fs-5 text-muted pb-5" data-aos="fade-right">
                            {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'section_contact.description'))) }}
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-11 col-lg-10 col-xl-8">
                        <div class="form-holder">
                            <form name="contactform" method="POST" class="row contact-form" novalidate="novalidate">
                                <div class="col-md-12 input-subject mb-4">
                                    <label class="p-lg">
                                        {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'section_contact.q1_text'))) }}:*
                                    </label>
                                    <div class="text-muted mb-2">
                                        {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'section_contact.q1_desc'))) }}
                                    </div>
                                    <select class="form-control subject">
                                        <option selected="">
                                            {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'section_contact.q1_text'))) }}
                                        </option>
                                        @foreach (data_get($pageAttributes, 'section_contact.q1_options', []) as $option)
                                            <option value="{{ $option }}">
                                                {{ ucfirst(BladeTranslator::__($option)) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <label class="p-lg">
                                        {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'section_contact.q2_text'))) }}:*
                                    </label>
                                    <div class="text-muted mb-2">
                                        {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'section_contact.q2_desc'))) }}
                                    </div>
                                    <input type="text" name="name" class="form-control name"
                                        placeholder="{{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'section_contact.q2_text'))) }}*">
                                    <div data-lastpass-icon-root=""
                                        style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                                    </div>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <label class="p-lg">
                                        {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'section_contact.q3_text'))) }}:*
                                    </label>
                                    <div class="text-muted mb-2">
                                        {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'section_contact.q3_desc'))) }}
                                    </div>
                                    <textarea class="form-control message" name="message" rows="6"
                                        placeholder=" {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'section_contact.q3_text'))) }}"></textarea>
                                </div>

                                <div class="col-md-12 mt-15 form-btn text-right my-3 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary btn--theme hover--theme submit">Submit
                                        Request
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
