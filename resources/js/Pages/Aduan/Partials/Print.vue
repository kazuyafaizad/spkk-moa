<script setup>
const props = defineProps({
    complaint: Object,
});
</script>

<template>
    <div
        id="printMe"
        style="
            display: none;
            font-family: Lato, Helvetica, sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 14px;
            line-height: 1.4;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            background-color: #f6f6f6;
            margin: 0;
            padding: 0;
        "
    >
        <table
            border="0"
            cellpadding="0"
            cellspacing="0"
            class="body"
            style="
                border-collapse: separate;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
                width: 100%;
                background-color: #f2f2f2;
            "
            width="100%"
            bgcolor="#F2F2F2"
        >
            <tr>
                <td
                    class="container"
                    style="
                        font-family: Lato, Helvetica, sans-serif;
                        font-size: 14px;
                        vertical-align: top;
                        margin: 0 auto !important;
                        max-width: 580px;
                        padding: 0 10px 10px;
                        width: 580px;
                    "
                    width="580"
                    valign="top"
                >
                    <div
                        class="content"
                        style="
                            box-sizing: border-box;
                            display: block;
                            margin: 0 auto;
                            max-width: 580px;
                            padding: 0 0 10px;
                        "
                    >
                        <!-- START CENTERED WHITE CONTAINER -->
                        <!-- <span class="preheader" style="color:transparent; display:none; height:0; max-height:0; max-width:0; opacity:0; overflow:hidden; mso-hide:all; visibility:hidden; width:0;">K-12 Learning & Educating Through Uncertainty</span> -->
                        <!-- START HEADER -->
                        <div
                            class="header"
                            style="
                                margin-bottom: 0px;
                                margin-top: 0px;
                                width: 100%;
                            "
                        >
                            <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                style="
                                    border-collapse: separate;
                                    mso-table-lspace: 0pt;
                                    mso-table-rspace: 0pt;
                                    width: 100%;
                                    min-width: 100%;
                                "
                                width="100%"
                            >
                                <tr>
                                    <td
                                        class="align-center"
                                        style="
                                            font-family: Lato, Helvetica,
                                                sans-serif;
                                            font-size: 14px;
                                            vertical-align: top;
                                            text-align: center;
                                            background-color: #ffffff;
                                        "
                                        valign="top"
                                        align="center"
                                        margin="0px;"
                                    >
                                        <a
                                            href="https://www.swcorp.gov.my/"
                                            target="_blank"
                                            style="
                                                color: #3e8ddd;
                                                text-decoration: underline;
                                            "
                                            ><img
                                                src="https://www.swcorp.gov.my/wp-content/uploads/2023/02/logo-swcorp.png"
                                                width="80"
                                                height="40"
                                                alt="Logo"
                                                align="left"
                                                style="
                                                    border: none;
                                                    -ms-interpolation-mode: bicubic;
                                                "
                                        /></a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- END HEADER -->
                        <table
                            border="0"
                            cellpadding="0"
                            cellspacing="0"
                            class="main"
                            style="
                                border-collapse: separate;
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                width: 100%;
                                background: #fff;
                                border-radius: 0.2em;
                            "
                            width="100%"
                        >
                            <tr>
                                <td
                                    style="
                                        font-family: Lato, Helvetica, sans-serif;
                                        font-size: 14px;
                                        vertical-align: top;
                                    "
                                    valign="top"
                                ></td>
                            </tr>
                            <!-- START MAIN CONTENT AREA -->
                            <tr>
                                <td
                                    class="wrapper"
                                    style="
                                        font-family: Lato, Helvetica, sans-serif;
                                        font-size: 14px;
                                        vertical-align: top;
                                        box-sizing: border-box;
                                        padding: 20px;
                                    "
                                    valign="top"
                                >
                                    <table
                                        border="0"
                                        cellpadding="0"
                                        cellspacing="0"
                                        style="
                                            border-collapse: separate;
                                            mso-table-lspace: 0pt;
                                            mso-table-rspace: 0pt;
                                            width: 100%;
                                        "
                                        width="100%"
                                    >
                                        <tr>
                                            <td
                                                style="
                                                    font-family: Lato, Helvetica,
                                                        sans-serif;
                                                    font-size: 14px;
                                                    vertical-align: top;
                                                "
                                                valign="top"
                                            >
                                                <h1
                                                    style="
                                                        color: #222222;
                                                        font-family: Lato,
                                                            Helvetica,
                                                            sans-serif;
                                                        font-weight: 300;
                                                        line-height: 1.1;
                                                        margin: 0;
                                                        margin-bottom: 30px;
                                                        font-size: 35px;
                                                        text-align: left;
                                                    "
                                                >
                                                    Aduan Awam({{
                                                        props.complaint.status
                                                            .name
                                                    }})
                                                </h1>
                                                <p
                                                    style="
                                                        font-family: Lato,
                                                            Helvetica,
                                                            sans-serif;
                                                        font-size: 14px;
                                                        margin: 0 0 15px;
                                                    "
                                                >
                                                    Nama Taman:
                                                    {{ complaint.park?.name }}
                                                </p>
                                                <p
                                                    style="
                                                        font-family: Lato,
                                                            Helvetica,
                                                            sans-serif;
                                                        font-size: 14px;
                                                        margin: 0 0 15px;
                                                    "
                                                >
                                                    Nama Jalan:
                                                    {{ complaint.street?.name }}
                                                </p>
                                                <p
                                                    style="
                                                        font-family: Lato,
                                                            Helvetica,
                                                            sans-serif;
                                                        font-size: 14px;
                                                        margin: 0 0 15px;
                                                    "
                                                >
                                                    Kod Aktivitin:
                                                    {{
                                                        complaint.schedule
                                                            ?.activity_codee
                                                    }}
                                                </p>
                                                <p
                                                    style="
                                                        font-family: Lato,
                                                            Helvetica,
                                                            sans-serif;
                                                        font-size: 14px;
                                                        margin: 0 0 15px;
                                                    "
                                                >
                                                    Masa:
                                                    {{
                                                        complaint.schedule
                                                            ?.time_start
                                                    }}
                                                    -
                                                    {{
                                                        complaint.schedule
                                                            ?.time_end
                                                    }}
                                                </p>
                                                <p
                                                    style="
                                                        font-family: Lato,
                                                            Helvetica,
                                                            sans-serif;
                                                        font-size: 14px;
                                                        margin: 0 0 15px;
                                                    "
                                                >
                                                    Tarikh:
                                                    {{
                                                        complaint.schedule?.date
                                                    }}
                                                </p>
                                                <table
                                                    border="0"
                                                    cellpadding="0"
                                                    cellspacing="0"
                                                    class="hr"
                                                    style="
                                                        border-collapse: separate;
                                                        mso-table-lspace: 0pt;
                                                        mso-table-rspace: 0pt;
                                                        width: 100%;
                                                    "
                                                    width="100%"
                                                >
                                                    <tbody>
                                                        <tr>
                                                            <td
                                                                style="
                                                                    font-family: Lato,
                                                                        Helvetica,
                                                                        sans-serif;
                                                                    font-size: 14px;
                                                                    vertical-align: top;
                                                                    height: 20px;
                                                                    line-height: 20px;
                                                                "
                                                                valign="top"
                                                            >
                                                                &nbsp;
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                height="1"
                                                                style="
                                                                    font-family: Lato,
                                                                        Helvetica,
                                                                        sans-serif;
                                                                    font-size: 14px;
                                                                    vertical-align: top;
                                                                    background-color: #f6f6f6;
                                                                    height: 1px;
                                                                    line-height: 1px;
                                                                    width: 100%;
                                                                "
                                                                width="100%"
                                                                valign="top"
                                                                bgcolor="#f6f6f6"
                                                            ></td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="
                                                                    font-family: Lato,
                                                                        Helvetica,
                                                                        sans-serif;
                                                                    font-size: 14px;
                                                                    vertical-align: top;
                                                                    height: 20px;
                                                                    line-height: 20px;
                                                                "
                                                                valign="top"
                                                            >
                                                                &nbsp;
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <h2
                                                    style="
                                                        color: #222222;
                                                        font-family: Lato,
                                                            Helvetica,
                                                            sans-serif;
                                                        font-weight: 400;
                                                        line-height: 1.4;
                                                        margin: 0 0 15px;
                                                        font-size: 28px;
                                                    "
                                                >
                                                    Keterangan Aduan
                                                </h2>
                                                <p
                                                    style="
                                                        font-family: Lato,
                                                            Helvetica,
                                                            sans-serif;
                                                        font-size: 14px;
                                                        font-weight: normal;
                                                        margin: 0 0 15px;
                                                    "
                                                >
                                                    {{
                                                        props.complaint
                                                            .description
                                                    }}
                                                </p>

                                                <table
                                                    border="0"
                                                    cellpadding="0"
                                                    cellspacing="0"
                                                    class="hr"
                                                    style="
                                                        border-collapse: separate;
                                                        mso-table-lspace: 0pt;
                                                        mso-table-rspace: 0pt;
                                                        width: 100%;
                                                    "
                                                    width="100%"
                                                >
                                                    <tbody>
                                                        <tr>
                                                            <td
                                                                style="
                                                                    font-family: Lato,
                                                                        Helvetica,
                                                                        sans-serif;
                                                                    font-size: 14px;
                                                                    vertical-align: top;
                                                                    height: 20px;
                                                                    line-height: 20px;
                                                                "
                                                                valign="top"
                                                            >
                                                                &nbsp;
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                height="1"
                                                                style="
                                                                    font-family: Lato,
                                                                        Helvetica,
                                                                        sans-serif;
                                                                    font-size: 14px;
                                                                    vertical-align: top;
                                                                    background-color: #f6f6f6;
                                                                    height: 1px;
                                                                    line-height: 1px;
                                                                    width: 100%;
                                                                "
                                                                width="100%"
                                                                valign="top"
                                                                bgcolor="#f6f6f6"
                                                            ></td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="
                                                                    font-family: Lato,
                                                                        Helvetica,
                                                                        sans-serif;
                                                                    font-size: 14px;
                                                                    vertical-align: top;
                                                                    height: 20px;
                                                                    line-height: 20px;
                                                                "
                                                                valign="top"
                                                            >
                                                                &nbsp;
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <h2
                                                    style="
                                                        color: #222222;
                                                        font-family: Lato,
                                                            Helvetica,
                                                            sans-serif;
                                                        font-weight: 400;
                                                        line-height: 1.4;
                                                        margin: 0 0 15px;
                                                        font-size: 28px;
                                                    "
                                                >
                                                    Lampiran
                                                </h2>
                                                <p
                                                    style="
                                                        font-family: Lato,
                                                            Helvetica,
                                                            sans-serif;
                                                        font-size: 14px;
                                                        font-weight: normal;
                                                        margin: 0 0 15px;
                                                    "
                                                ></p>
                                                <ul style="padding-left: 25px">
                                                    <li
                                                        v-for="(
                                                            img, idx
                                                        ) in props.complaint
                                                            .lampiran"
                                                        :key="idx"
                                                        class="pic"
                                                    >
                                                        <img
                                                            :src="
                                                                img.url
                                                                    ? img.url
                                                                    : img
                                                            "
                                                        />
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    class="wrapper section-callout"
                                    style="
                                        font-family: Lato, Helvetica, sans-serif;
                                        font-size: 14px;
                                        vertical-align: top;
                                        box-sizing: border-box;
                                        padding: 10px 20px 30px;
                                        background-color: #bbbbbb;
                                        color: #373737;
                                    "
                                    valign="top"
                                    bgcolor="#D13811"
                                >
                                    <table
                                        border="0"
                                        cellpadding="0"
                                        cellspacing="0"
                                        style="
                                            border-collapse: separate;
                                            mso-table-lspace: 0pt;
                                            mso-table-rspace: 0pt;
                                            width: 100%;
                                        "
                                        width="100%"
                                    >
                                        <tr>
                                            <td
                                                class="align-center"
                                                style="
                                                    font-family: Lato, Helvetica,
                                                        sans-serif;
                                                    font-size: 14px;
                                                    vertical-align: top;
                                                    text-align: center;
                                                    color: #373737;
                                                "
                                                valign="top"
                                                align="center"
                                            >
                                                <p
                                                    style="
                                                        padding-bottom: 0px;
                                                        margin-bottom: 0px;
                                                    "
                                                >
                                                    Aduan cetakan komputer.
                                                </p>
                                                <br />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- END CALL OUT -->
                        </table>
                        <!-- START FOOTER -->
                    </div>
                </td>
            </tr>
        </table>
    </div>
</template>
