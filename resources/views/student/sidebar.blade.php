<li>
    <a href="/dashboard">
        <i class="fa fa-dashboard"></i>
        <span class="sidebar-mini-hide">עמוד ראשי</span>
    </a>
</li>
<li class="nav-main-heading">
    <span class="sidebar-mini-visible">כללי</span>
    <span class="sidebar-mini-hidden">כללי</span>
</li>
<li>
    <a href="/noticeboard"><i class="fa fa-globe"></i><span class="sidebar-mini-hide">הודעות כלליות</span></a>
</li>
<li>
    <a href="/teachers"><i class="fa fa-group"></i><span class="sidebar-mini-hide">רשימת מורים</span></a>
</li>
<li>
    <a href="/studentscontact"><i class="fa fa-vcard"></i><span class="sidebar-mini-hide">דף קשר כיתתי</span></a>
</li>
<li class="nav-main-heading">
    <span class="sidebar-mini-visible">תוכן אקדמי</span>
    <span class="sidebar-mini-hidden">תוכן אקדמי</span>
</li>
<li>
    <a href="/routine"><i class="fa fa-book"></i><span class="sidebar-mini-hide">מערכת שעות</span></a>
</li>
<li>
    <a href="/attendance"><i class="fa fa-eye"></i><span class="sidebar-mini-hide">נוכחות</span></a>
</li>
<li>
    <a href="/behaviour"><i class="fa fa-ban"></i><span class="sidebar-mini-hide">אירועי משמעת</span></a>
</li>
<li>
    <a class="nav-submenu" data-toggle="nav-submenu" href="#">
        <i class="fa fa-list-ul"></i>
        <span class="sidebar-mini-hide">מבחנים</span>
    </a>
    <ul>
        <li>
            <a href="/exams_schedule">דף מבחנים</a>
        </li>
        <li>
            <a href="/exams">ציונים שוטפים ותקופתיים</a>
        </li>
        @if(\App\models\Bagruts::where('student_id', Auth::user()->id)->count())
        <li>
            <a href="/bagruts">ציוני הגשה ובגרויות</a>
        </li>
        @endif
    </ul>
</li>
<li class="nav-main-heading">
    <span class="sidebar-mini-visible">אונליין</span>
    <span class="sidebar-mini-hidden">אונליין</span>
</li>
<li>
    <a href="/homework"><i class="fa fa-archive"></i><span class="sidebar-mini-hide">שיעורי בית</span></a>
</li>
<li>
    <a href="/studymaterials"><i class="fa fa-cloud-download"></i><span class="sidebar-mini-hide">חומרי לימוד</span></a>
</li>
<li>
    <a href="#"><i class="fa fa-graduation-cap"></i><span class="sidebar-mini-hide">מבחנים אונליין</span></a>
</li>
