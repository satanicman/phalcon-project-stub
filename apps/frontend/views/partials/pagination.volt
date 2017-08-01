{% if p is defined and p and start != stop %}
    {% set no_follow_text = ' rel="nofollow"' %}
    <nav aria-label="Page navigation" class="pagination-wrap">
        <ul class="pagination">
            {% if p != 1 %}
                <li class="page-item page-arrow">
                    <a{{ no_follow_text }} href="{{ link.goPage(requestPage, p-1) }}" class="page-link" aria-label="Previous">
                        <i class="icon chevron-blue-left-icon"></i>
                    </a>
                </li>
            {% else %}
                <li class="disabled page-item page-arrow">
                  <span class="page-link">
                      <i class="icon chevron-blue-left-icon"></i>
                  </span>
                </li>
            {% endif %}
            {% if start == 3 %}
                <li class="page-item">
                    <a{{ no_follow_text }} href="{{ link.goPage(requestPage, 1) }}" class="page-link">
                        <span>1</span>
                    </a>
                </li>
                <li class="page-item">
                    <a{{ no_follow_text }} href="{{ link.goPage(requestPage, 2) }}" class="page-link">
                        <span>2</span>
                    </a>
                </li>
            {% endif %}
            {% if start == 2 %}
                <li class="page-item">
                    <a{{ no_follow_text }} href="{{ link.goPage(requestPage, 1) }}" class="page-link">
                        <span>1</span>
                    </a>
                </li>
            {% endif %}
            {% if start > 3 %}
                <li class="page-item">
                    <a{{ no_follow_text }} href="{{ link.goPage(requestPage, 1) }}" class="page-link">
                        <span>1</span>
                    </a>
                </li>
                <li class="truncate">
                    <span>
                        <span>...</span>
                    </span>
                </li>
            {% endif %}
            {% for i in start..stop %}
                <li class="page-item{% if p == i %} active{% endif %}">
                    <a{{ no_follow_text }} href="{{ link.goPage(requestPage, i) }}" class="page-link">{{i}}</a>
                </li>
            {% endfor %}
            {% if pages_nb > stop+2 %}
                <li class="truncate">
                    <span>
                        <span>...</span>
                    </span>
                </li>
                <li class="page-item">
                    <a{{ no_follow_text }} href="{{ link.goPage(requestPage, pages_nb) }}" class="page-link">
                        <span>{{ pages_nb }}</span>
                    </a>
                </li>
            {% endif %}
            {% if pages_nb == stop+1 %}
                <li class="page-item">
                    <a{{ no_follow_text }} href="{{ link.goPage(requestPage, pages_nb) }}" class="page-link">
                        <span>{{pages_nb}}</span>
                    </a>
                </li>
            {% endif %}
            {% if pages_nb == stop+2 %}
                <li class="page-item">
                    <a{{ no_follow_text }} href="{{ link.goPage(requestPage, pages_nb-1) }}" class="page-link">
                        <span>{{pages_nb-1}}</span>
                    </a>
                </li>
                <li class="page-item">
                    <a{{ no_follow_text }} href="{{ link.goPage(requestPage, pages_nb) }}" class="page-link">
                        <span>{{pages_nb}}</span>
                    </a>
                </li>
            {% endif %}

            {% if pages_nb > 1 AND p != pages_nb %}
                <li class="page-item page-arrow">
                    <a{{ no_follow_text }} href="{{ link.goPage(requestPage, p+1) }}" aria-label="Next" class="page-link">
                        <i class="icon chevron-blue-right-icon"></i>
                    </a>
                </li>
            {% else %}
                <li class="page-item disabled page-arrow">
                  <span class="page-link">
                      <i class="icon chevron-blue-right-icon"></i>
                  </span>
                </li>
            {% endif %}
        </ul>
    </nav>
{% endif %}